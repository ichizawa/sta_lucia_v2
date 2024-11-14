// $(document).ready(function () {
//     console.log('Document is ready');

//     if (typeof window.Echo !== 'undefined') {
//         window.Echo.private('tenants')
//             .listen('.tenant.updated', (event) => {
//                 console.log('Owner', event.owner);
//                 console.log('Company', event.company);
//                 console.log('Representative', event.representative);

//                 updateTable(event.owner, event.company, event.representative);
//             });
//     } else {
//         console.error('Laravel Echo is not defined.');
//     }

//     function updateTable(owner, company, representative) {
//         let tablebody = $('.tenant-table tbody');
//         tablebody.empty();

//         let data = [
//             { company_name: company.company_name }
//         ];

//         $.each(data, function(index, item) {
//             tablebody.append(`
//                 <tr>
//                     <td>${item.company_name}</td>
//                 </tr>
//             `);
//         });
//     }
// });
