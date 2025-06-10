$(document).ready(function () {
  const ledger = $('#ledgerTable').DataTable({
    pageLength: 10,
    columns: [
      { data: 'bill_no',        className: 'text-center' },
      { data: 'transaction_id', className: 'text-center' },
      {
        data: 'debit',
        className: 'text-center',
        render: d => parseFloat(d).toFixed(2),
      },
      {
        data: 'credit',
        className: 'text-center',
        render: d => parseFloat(d).toFixed(2),
      },
      { data: 'remarks',        className: 'text-center' },
      {
        data: 'created_at',
        className: 'text-center',
        render: d => formatDate(d),
      },
    ],
  });

  $('#ledgerTableModal').on('show.bs.modal', function (event) {
    const id = $(event.relatedTarget).data('id');
    $.ajax({
      url: LEDGER_TABLE,
      type: 'GET',
      dataType: 'json',
      data: { id },
      success(data) {
        ledger.clear().rows.add(data).draw();
        $('#backtocontractlist').data('id', id);
      },
      error(xhr) { console.log(xhr.responseText) },
    });
  });

  // ─── Pusher ─────────────────────────────────────────────────────────
  Pusher.logToConsole = true;
  const pusher = new Pusher('1eedc3e004154aadb5dc', {
    cluster: 'ap1',
    forceTLS: true
  });
  const channel = pusher.subscribe('collector-channel');

  channel.bind('collector-updated', payload => {
    // only reload if that same modal is open
    if (!$('#ledgerTableModal').hasClass('show')) return;

    const currentId = $('#backtocontractlist').data('id');
    if (payload.proposal_id !== currentId) return;

    // re-fetch and redraw
    $.ajax({
      url: LEDGER_TABLE,
      type: 'GET',
      dataType: 'json',
      data: { id: currentId },
      success(data) {
        ledger.clear().rows.add(data).draw();
      },
      error(xhr) { console.log(xhr.responseText) },
    });
  });

  function formatDate(date) {
    return new Date(date)
      .toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
  }
});
