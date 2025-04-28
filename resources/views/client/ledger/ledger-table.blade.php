@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Ledger</h3>
                <h6 class="op-7 mb-2">Tenant Billing Ledger</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ledger Table</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="client" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Billing #</th>
                                        <th class="text-center">Transaction Number</th>
                                        <th class="text-center">Debit</th>
                                        <th class="text-center">Credit</th>
                                        <th class="text-center">Remarks</th>
                                        <th class="text-center">Transaction Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($ledgerData as $ledger)
                                        <tr>
                                            <td class="text-center">{{ $ledger->bill_no }}</td>
                                            <td class="text-center">{{ $ledger->transaction_id }}</td>
                                            <td class="text-center">{{ $ledger->debit }}</td>
                                            <td class="text-center">{{ $ledger->credit }}</td>
                                            <td class="text-center">{{ $ledger->remarks }}</td>
                                            <td class="text-center date-to">{{ $ledger->created_at }}</td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function formatDate(date) {
        const options = {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        };
        return new Date(date).toLocaleDateString('en-US', options);
    }

    document.addEventListener("DOMContentLoaded", function() {
        const dateCells = document.querySelectorAll(".date-to");
        dateCells.forEach(cell => {
            const originalDate = cell.textContent.trim();
            const formatted = formatDate(originalDate);
            cell.textContent = formatted;
        });
    });
</script>
