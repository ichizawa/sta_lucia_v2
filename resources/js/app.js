import './bootstrap';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'd66c3e9ae452970fabec',
    cluster: 'ap1',
    forceTLS: true,
    encrypted: true
});

window.Echo.channel('spaces')
    .listen('SpaceCreated', (event) => {
        const space = event;
        location.reload();

        const existingRow = Array.from(document.querySelectorAll('#spaceList .space-id')).find((element) => {
            return element.textContent == space.id;
        });

        if (!existingRow) {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><span class="space-id" style="display:none;">${space.id}</span>${space.space_name}</td>
                <td>${space.store_type}</td>
                <td>${space.space_area} per sqm</td>
                <td>${space.property_code}</td>
                <td>${space.store_type}</td>
                <td>${space.space_type}</td>
                <td>${space.status === 'Unavailable'
                    ? '<span class="badge bg-warning">Unavailable</span>'
                    : '<span class="badge bg-success">Available</span>'}</td>
                <td>${space.space_tag === 'Available'
                    ? '<span class="badge bg-success">Available</span>'
                    : (space.space_tag === 'Unavailable'
                        ? '<span class="badge bg-warning">Unavailable</span>'
                        : '<span class="badge bg-danger">Reserved</span>')}</td>
                <td>
                    <a class="btn btn-warning btn-sm space-view" data-spaceid="${space.id}">
                        <i class="fa fa-pen" aria-hidden="true"></i>
                    </a>
                </td>
            `;

            document.getElementById('spaceList').appendChild(newRow);
        }
    });

