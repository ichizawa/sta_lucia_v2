<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">

    <title>Lease Proposal</title>
    <style>
        body {
            /* font-size: 6px; */
            font-family: Arial, sans-serif;
            margin: 0.5in;
        }

        .container {
            max-width: 10.5in;
            margin: 0 auto;
        }

        .section-title {
            font-weight: bold;
            margin-top: 10px;
            font-size: 7px;
        }

        .requirements {
            font-size: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            font-size: 6.5px;
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        /* th {
            background-color: #f4f4f4;
        } */

        .text-center {
            text-align: center;
        }

        .signature-section {
            font-size: 8.5px;
        }

        .row-signature:after {
            content: "";
            display: table;
            clear: both;
        }

        .row-signature .col {
            margin-top: -10px;
            float: left;
            width: 85%;
        }
    </style>
</head>

<body>
    <div class="container" style="margin-top: -100px">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/assets/img/sta_lucia_logo2.png'))) }}"
            alt="" style="width: 15%;">
        <div class="page-header">
            <h2 class="text-center" style="font-size: 10px">Counter Lease Proposal as of
                {{ date('F j, Y', strtotime($counter_proposal->created_at)) }}
            </h2>
        </div>

        <div class="section-title">General Information</div>
        <table>
            <tr>
                <th>Trade Name</th>
                <td>{{ ucwords($counter_proposal->proposal->company->company_name) }}</td>
            </tr>
            <tr>
                <th>Company Lesee</th>
                <td>{{ ucwords($counter_proposal->proposal->company->store_name) }}</td>
            </tr>
            <tr>
                <th>Nature of Business</th>
                <td>{{ $counter_proposal->bussiness_nature }}</td>
            </tr>
            <tr>
                <th>Authorized Representative</th>
                <td>{{ ucfirst($counter_proposal->proposal->representative->rep_fname) . ' ' . ucfirst($counter_proposal->proposal->representative->lname) }}
                </td>
            </tr>
            <tr>
                <th>Designation</th>
                <td>{{ ucfirst($counter_proposal->proposal->representative->rep_position) }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $counter_proposal->proposal->company->company_address }}</td>
            </tr>
            <tr>
                <th>Contact Number</th>
                <td>{{ ucwords($counter_proposal->proposal->representative->rep_mobile) }}</td>
            </tr>
            <tr>
                <th>Email Address</th>
                <td>{!! '<a href="#">' . $counter_proposal->proposal->representative->rep_email . '</a>' !!}</td>
            </tr>
        </table>
        <!-- Abbreviated Rate -->
        <div class="section-title">Area/Rental Rate</div>
        <table>
            <tr>
                <th>Space Name</th>
                <td>{{ collect($counter_proposal->proposal->selected_space)->pluck('space.space_name')->implode(', ') }}
                </td>
            </tr>
            <tr>
                <th>Area Code</th>
                <td>{{ collect($counter_proposal->proposal->selected_space)->pluck('space.property_code')->implode(', ') }}
                </td>
            </tr>
            <tr>
                <th>Total Floor Area</th>
                <td>{{ collect($counter_proposal->proposal->selected_space)->sum('space.space_area') . ' sqm' }}</td>
            </tr>
            <tr>
                <th>Basic Rent per sqm</th>
                <td>PHP {{ $counter_proposal->brent }} per sqm</td>
            </tr>
            <tr>
                <th>Please Select if FOOD,NONFOOD or Percentage</th>
                <td>-</td>
            </tr>
            <tr>
                <th>Minimum Guaranteed Rent per sqm</th>
                <td>PHP {{ number_format($counter_proposal->min_mgr, 2) }}</td>
            </tr>
            <tr>
                <th>TOTAL Basic Rent</th>
                <td>PHP {{ number_format($counter_proposal->total_rent, 2) }}</td>
            </tr>
            <tr>
                <th>TOTAL MGR - Minimum Guaranteed Rent</th>
                <td>PHP
                    {{ number_format($counter_proposal->total_mgr, 2) }}
                </td>
            </tr>
        </table>

        @php
            $uniqueAmenities = collect($counter_proposal->proposal->selected_space)
                ->pluck('space.amenities')
                ->flatten()
                ->pluck('amenity')
                ->unique('amenity_name');
        @endphp

        <div class="section-title">Amenities</div>
        <table>
            @foreach ($uniqueAmenities as $amenity)
                <tr>
                    <th>{{ $amenity['amenity_name'] }}</th>
                    <td>-</td>
                </tr>
            @endforeach
        </table>

        <div class="section-title">Utilities</div>
        <table>
            @foreach ($counter_proposal->proposal->utilities->unique('utility_id') as $utilities)
                <tr>
                    <th>{{ $utilities->util_desc->utility_name }}</th>
                    <td>{{ $utilities->util_desc->utility_price }}/per meter </td>
                </tr>
            @endforeach
        </table>

        <!-- Other Charges -->
        <div class="section-title">Other Charges</div>
        <table>
            @foreach ($counter_proposal->proposal->charges->unique('charge_id') as $charges)
                <tr>
                    <th>{{ $charges->charge->charge_name }}</th>
                    <td>PHP {{ $charges->charge->charge_fee }}/sqm ({{ $charges->charge->frequency }})</td>
                </tr>
            @endforeach
        </table>

        <!-- Lease Term / Construction Period -->
        <div class="section-title">Lease Term / Construction Period</div>
        <table>
            <tr>
                <th>Lease Term</th>
                <td>{{ $counter_proposal->lease_term }}</td>
            </tr>
            <tr>
                <th>Commencement</th>
                <td>{{ date('F Y', strtotime($counter_proposal->commencement)) }}</td>
            </tr>
            <tr>
                <th>End of Lease Contract</th>
                <td>{{ date('F Y', strtotime($counter_proposal->end_contract)) }}</td>
            </tr>
            <tr>
                <th>Construction Period</th>
                <td>{{ $counter_proposal->const_period }}</td>
            </tr>
        </table>

        <!-- Rental Deposits / Escalation Rate -->
        <div class="section-title">Rental Deposits / Escalation Rate</div>
        <table>
            <tr>
                <th>Advance Rent(Equivalent to Two (2) Months Basic Rent)</th>
                <td>{{ $counter_proposal->rent_deposit }}</td>
            </tr>
            <tr>
                <th>Security Deposit (Equivalent to Two (2) Months Basic Rent)</th>
                <td>{{ $counter_proposal->sec_dep }}</td>
            </tr>
            <tr>
                <th>Escalation Rate</th>
                <td>{{ $counter_proposal->escalation_rate }}%</td>
            </tr>
        </table>

        <div class="footer text-center" style="margin-top: 4px; font-size: 6px;">* Monthly Rate and Other Charges are
            VATABLE</div>

        <div class="requirements pt-5" style="margin-top: 7px">
            <div class="text-center">
                <p>
                    The basic term and conditions of your proposed lease of the identified development space, as
                    indicated in the floor layout plan attached hereto.
                    <br>Please submit the following documents prior to the execution of the Award Notice.
                </p>
            </div>
            <div class="pt-3">
                <ol>
                    <li>SEC Registration with Articles and By-Laws (If Corporation & Partnership) or DTI Registration
                        (If Proprietor)</li>
                    <li>Secretary's Certificate (If Corporation) or Partner's Resolution (If Partnership) for Authorized
                        Contract Signatory</li>
                    <li>Two (2) Valid Government-Issued IDs with picture and signature of the Contract Signatory (e.g.,
                        SSS ID, Passport, Driver's License, PRC ID, Senior Citizen’s ID, TIN ID)</li>
                </ol>
            </div>
            <div class="pt-3 text-center" style="margin-top: -15px">
                <p class="text-uppercase">We shall provide you with the formal award notice after management's final
                    approval of the terms hereof.</p>
            </div>
        </div>

        <div class="signature-section">
            <div class="row">
                <div class="col">
                    <p>Proposed by:</p>
                    <div>Ms. Mary Grace Castillo-Augusto</div>
                    <div>Leasing Consultant - Commercial Business Group</div>
                    <div>Sta. Lucia Land Inc.</div>
                </div>
            </div>
            <div class="row row-signature" style="margin-top: 20px">
                <div class="col">
                    <p>Noted by:</p>
                    <div>Ms. Rosario Santos-Montalbo</div>
                    <div>VP - Commercial Business Group</div>
                    <div>Sta. Lucia Land Inc.</div>
                </div>
                <div class="col">
                    <p>Conforme:</p>
                    <div>
                        {{ ucfirst($counter_proposal->proposal->representative->rep_fname) . ' ' . ucfirst($counter_proposal->proposal->representative->lname) }}
                    </div>
                    <div>{{ ucfirst($counter_proposal->proposal->representative->rep_email) }}</div>
                    <div>{{ ucwords($counter_proposal->proposal->owner->owner_email) }}</div>
                    <div>Date: <u>{{ date('m/d/Y', strtotime($counter_proposal->created_at)) }}</u></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
