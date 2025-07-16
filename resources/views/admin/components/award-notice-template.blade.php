<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Award Notice</title>
    <meta name="author" content="Icelle A. Notob" />

    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            text-indent: 0;
        }

        body {
            margin: 0.5in;
            font-family: Arial, sans-serif;
            font-size: 10pt;
        }

        .container {
            max-width: 10.5in;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            /* padding: 5px; */
            text-align: left;
        }

        .separator {
            width: 5%;
        }

        tr {
            vertical-align: top;
        }

        td {
            width: 50%;
        }

        .center_h2 {
            text-align: center;
            font-size: 10pt;
            margin-bottom: 20px;
        }

        .unique_td {
            text-indent: 40px;
        }

        .footer_contents {
            margin-top: 20px;
        }
    </style>

</head>

<body>

    <div class="container">
        <div>
            <p>
                <span>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <img width="15%"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/assets/img/sta_lucia_logo2.png'))) }}" />
                            </td>
                        </tr>
                    </table>
                </span>
            </p>
            <h2 class="center_h2">AWARD NOTICE</h2>
        </div>
        <div>
            <p><strong>{{ $proposal->owner->owner_fname . ' ' . $proposal->owner->owner_lname}}</strong>
            </p>
            <!-- <p>Business Development Supervisor</p> -->
            <p><strong>{{ $proposal->company->store_name }}</strong></p>
            <p><strong>{{ $proposal->company->company_name }}</strong></p>
            <p>{{ $proposal->company->company_address }}</p>
            <p style="text-align: right;">{{ date('d F Y', strtotime($proposal->created_at)) }}</p>
            <p style="margin-top: 20px;">Dear Ms. Enaluz,</p>
            <p style="margin-top: 20px; margin-bottom: 20px;">This is to formalize our discussion regarding your outlet
                at Sta Lucia Mall of Davao. We have outlined our terms and conditions for your conformity.</p>
        </div>
        <table>
            <tbody>
                <tr>
                    <td>1. Trade Name</td>
                    <td class="separator">:</td>
                    <td><strong>{{ $proposal->company->store_name }}</strong></td>
                </tr>
                <tr>
                    <td>2. Location</td>
                    <td class="separator">:</td>
                    <td>{{ collect($proposal->selected_space)->pluck('space.space_name')->implode(', ') }}
                        ({{ collect($proposal->selected_space)->pluck('space.store_type')->implode(', ') }})</td>
                </tr>
                <tr>
                    <td>3. Area</td>
                    <td class="separator">:</td>
                    <td>{{ collect($proposal->selected_space)->pluck('space.space_area')->implode(', ') }} sqm.</td>
                </tr>
                <tr>
                    <td>4. Monthly Rental</td>
                </tr>
                <tr>
                    <td class="unique_td">Basic Rent</td>
                    <td class="separator">:</td>
                    <td><strong>P {{ number_format($proposal->brent, 2) }}/mo.</strong></td>
                </tr>
                <tr>
                    <td class="unique_td">Percentage Rent</td>
                    <td class="separator">:</td>
                    <td><strong>
                        
                        {{$proposal->percentage_sale}}% of Gross Sales OR
                        </strong></td>
                </tr>
                <tr>
                    <td class="unique_td">Minimum Guaranteed Rent</td>
                    <td class="separator">:</td>
                    <td><strong>P {{ number_format($proposal->min_mgr, 2) }}/sqm./mo.</strong></td>
                </tr>
                <tr>
                    <td class="unique_td">Total Monthly Rent</td>
                    <td class="separator">:</td>
                    <td><strong>Basic Rent plus Percentage Rent or MGR (whichever is higher)</strong></td>
                </tr>
                <tr>
                    <td>5. Value Added Tax</td>
                    <td class="separator">:</td>
                    <td>Twelve Percent (12%) of the Monthly Rent</td>
                </tr>
            </tbody>
        </table>
        <p>6. Other Charges (subject to review/change by Sta Lucia Mall when circumstances demand so)</p>
        <table>
            <tbody>
                @foreach ($proposal->charges->unique('charge_id') as $charges)
                    <tr>
                        <td class="unique_td">{{ $charges->charge->charge_name }}</td>
                        <td class="separator">:</td>
                        <td><strong>P {{ number_format($charges->charge->charge_fee, 2) }}/sqm.
                                {{ $charges->charge->frequency }}</strong>
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td class="unique_td">Electricity/Water</td>
                    <td class="separator">:</td>
                    <td>Metered</td>
                </tr>

                <tr>
                    <td>7. Interest on Unpaid Charges</td>
                    <td class="separator">:</td>
                    <td>Three percent (3%) per month or maximum prevailing interest rate set by law or commercial
                        parties</td>
                </tr>
                <tr>
                    <td>8. Nature of Business</td>
                    <td class="separator">:</td>
                    <td>{{ $proposal->bussiness_nature }}</td>
                </tr>
                <tr>
                    <td>9. Items Allowed</td>
                    <td class="separator">:</td>
                    <td>Footwear as approved by the Lessor</td>
                </tr>
                <tr>
                    <td>10. Escalation Rate</td>
                    <td class="separator">:</td>
                    <td>Ten percent (10%) per annum</td>
                </tr>
                <tr>
                    <td>11. Deposits</td>
                </tr>
                <tr>
                    <td class="unique_td">Security Deposit</td>
                    <td class="separator">:</td>
                    <td><strong>P {{ number_format($proposal->sec_dep, 2) }}</strong> – Equivalent to two (2) months
                        basic rent and refundable upon
                        termination
                        of Contract of Lease. This is payable upon signing of the Award Notice. If the LESSEE
                        pre-terminates the
                        contract for whatever reason, the Security Deposit will be automatically forfeited in favor of
                        Sta Lucia
                        Mall of Davao.</td>
                </tr>
                <tr>
                    <td class="unique_td">Advance Deposit</td>
                    <td class="separator">:</td>
                    <td><strong>P {{ number_format($proposal->rent_deposit, 2) }}</strong> – Equivalent to two (2) months
                        basic rent and refundable upon
                        termination
                        of Contract of Lease. This is payable upon signing of the Award Notice. If the LESSEE
                        pre-terminates the
                        contract for whatever reason, the Security Deposit will be automatically forfeited in favor of
                        Sta Lucia
                        Mall of Davao.</td>
                </tr>
                <tr>
                    <td class="unique_td">Electric Bill Deposit</td>
                    <td class="separator">:</td>
                    <td>Average of first three (3) months of consumption in kilowatt hours times two (2) months. To be
                        computed
                        after the third monthly electric reading and shall be reflected in the following month's
                        statement of
                        account.</td>
                </tr>
                <tr>
                    <td class="unique_td">Electric Meter Deposit</td>
                    <td class="separator">:</td>
                    <td>Actual cost of normal and emergency meters. To be reflected on Lessee's statement of account.
                    </td>
                </tr>
                <tr>
                    <td>12. Construction Bond</td>
                    <td class="separator">:</td>
                    <td><strong>P 36,000.00</strong> – Equivalent to one (1) month basic rent and payable upon signing
                        of the
                        Award Notice. To be refunded upon compliance with all technical requirements of our Technical
                        Department. Any deficiency must be corrected within 60 days from the start of operations.
                        Otherwise,
                        said bond shall be forfeited. Corrections of deficiencies shall then be undertaken by Sta Lucia
                        Mall of
                        Davao c/o Operations Department and charged to Lessee's account.</td>
                </tr>
                <tr>
                    <td>13. Contractor's All Risk Insurance</td>
                    <td class="separator">:</td>
                    <td>P 500,000.00 (CARI) bodily injury and property damage to third party for the duration of the
                        construction.</td>
                </tr>
                <tr>
                    <td>14. Timetable for Completing Construction</strong></td>
                    <td class="separator">:</td>
                    <td>The LESSOR shall advise LESSEE in writing upon turnover of space the period during which
                        construction
                        should be completed. This construction period is rent- free. If the LESSEE fails to finish
                        construction
                        at the end of said period, LESSOR has the option to cancel the Award Notice or the Contract of
                        Lease. If
                        LESSEE completes the construction earlier than the given rent- free period, rent shall commence
                        upon the
                        first day of operations.</td>
                </tr>
                <tr>
                    <td>15. Lease Term</td>
                    <td class="separator">:</td>
                    <td>{{ $proposal->lease_term }}</td>
                </tr>
                <tr>
                    <td>16. Commencement Date</td>
                    <td class="separator">:</td>
                    <td><strong>{{ date('F d, Y', strtotime($proposal->commencement)) }} (tentative)</strong></td>
                </tr>
                <tr>
                    <td>17. Termination Date</td>
                    <td class="separator">:</td>
                    <td><strong>{{ date('F d, Y', strtotime($proposal->end_contract)) }}</strong></td>
                </tr>
            </tbody>
        </table>
        <div class="footer_contents">
            <p style="margin-bottom: 20px;">Sta Lucia Mall has the right to pre-terminate this contract and immediately
                take
                over the leased area even without a court order should the LESSEE fail to settle his account equivalent
                to two
                (2) months' rent. The outstanding balance of his account shall then be deducted from the security
                deposit.</p>
            <p style="margin-bottom: 20px;">Business hours shall strictly comply with the following Sta Lucia Mall store
                hours:
            </p>
            <p style="text-align: center;"><strong>Monday to Sunday (including holidays) 10:00 a.m. to 9:00
                    p.m.</strong></p>
            <p style="margin-top: 20px;">The LESSEE shall secure the written approval of Sta Lucia Mall of Davao at
                least three
                (3) calendar days in advance if it intends to close their outlet. Sta Lucia Mall shall impose a penalty
                of P
                100.00/sqm./per day for any unauthorized closure/non-operation. Sta Lucia Mall shall impose a penalty of
                P
                100.00 per sqm. of any unexcused late opening and/or early closing of the outlet. Computation shall be
                done
                cumulatively and any fraction thereof of sixty (60) minutes shall be computed on a pro-rata basis. Said
                penalties are subject to review/change by Sta Lucia Mall of Davao when circumstances so demand.</p>
            <p style="margin-top: 20px;">The LESSEE shall be responsible for all promotional and advertising campaigns
                and
                activities with prior approval by the Sta Lucia Mall Ad & Promo Department.</p>
            <p style="margin-top: 20px;">The LESSEE shall promote Sta Lucia Mall in all its collateral, press releases,
                print
                ads, banners, island signs, etc.</p>
            <p style="margin-top: 20px;">The LESSEE shall be responsible for the security and maintenance of the leased
                area,
                and likewise the proper implementation of Sta Lucia Mall of Davao House Rules and Regulations.</p>
            <p style="margin-top: 20px;">Kindly sign on the space provided below to signify your conformity and return
                the
                notice to us within seven (7) days from receipt thereof. Your failure to comply or contest the
                provisions within
                the stated period shall be construed to mean that you are agreeable to the provisions stated herein.</p>
            <p style="margin-top: 20px; margin-bottom: 30px;">Very truly yours,</p>
            <p><strong>MS. MARY GRACE C. AGUSTO</strong></p>
            <p>LEASING HEAD</p>
            <p style="text-indent: 5in;">Conforme:</p>
            <p>Noted by:</p>
            <p style="text-indent: 5in;"><strong>MR. WEE SHIONG HOW</strong></p>
            <p style="text-indent: 5in;">OWNER/LEESSE</p>
            <p><strong>MS. MA.ROSARIO L. SANTOS</strong></p>
            <p>VP – Marketing and Mall Operations</p>
            <p style="text-indent: 5in;">Date:_________</p>
            <p>cc: Lease Admin. / Accounting / Operations / Clafile</p>
            <div>
            </div>
</body>

</html>