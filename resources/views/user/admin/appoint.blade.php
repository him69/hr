<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Appointment Letter</title>
<style>
    *{
        font-size: 10px;
        margin-bottom: 0;
        text-align: justify;
    }
    li{margin-bottom: 5px;list-style-type: circle;}

    h4 {
        margin-top: 30px;
    }
    h4 span{
        font-size:1.5rem;display:inline-block;
    border-bottom:1px solid black;
    padding-bottom:1px;
    }
    .sheet1 {
        position: absolute;
        padding: 110px 80px;
        top: 0;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }
    .qw {
        font-size: 20px;
    }
    span,
    h2,
    h3,
    h4 {
        /*text-decoration: underline;*/
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }.sign {
        font-size: 13px;
    }
</style>
<style>
@font-face {
  font-family: 'Dancing Script';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(data:@file/octet-stream;base64,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) format('woff2');
}
    #sign{
        /*font-family: 'Dancing Script', cursive!important;*/
        font-size:15px;
        font-style:oblique;
    }
</style>
</head>
<body class="m-0 d-flex flex-column justify-content-center align-items-center"
    style=" font-family: 'Times New Roman', Times, serif;">
    <div id="page-container">
        <div id="pf1" class="pf w0 h0" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/HR Generalist.svg" alt="" style="width:100%;">
            <div class="sheet1">
                <p>
                    {{$ext['date']}} <br>
                    To, <br>
                    {{$ext['fname']}} <br>
                    {{$ext['address']}} <br>
                    {{$ext['city']}}, {{$ext['state']}}, {{$ext['pin']}}
                </p>
                <h4 class="my-5 text-center"><span>Appointment Letter</span></h4>
                <p>Dear {{$ext['fname']}}, </p>
                <p>We are pleased to offer you the position of {{$ext['position']}}, {{$ext['department']}} with ‘Pantheon
                    Digital
                    Private Limited’. Your employment
                    shall
                    commence with effect from your actual date of joining which is {{$ext['jdate']}}, for {{$ext['place']}}.</p>
<br>
                <p>You shall be on probation for a period of Three (3) months (the 'Probation Period') from your
                    actual date of
                    joining, which may be extended by the Company at its discretion. During the Probation Period, your
                    Compensation and Other Entitlements, if any, shall be in accordance with the Company's Policy. At
                    the end of
                    the Probation Period, the Company may confirm your services, subject to your performance meeting the
                    requisite standard, Key Responsibility Areas (the ‘KRA(s)’) and Key Performance Indicators (the
                    ‘KPI(s)’),
                    by issuing a confirmation letter. Until such a Confirmation Letter is
                    issued,
                    you are deemed to be on probation.</p>
                    <p>The terms and conditions of your employment with the Company shall be as follows:</p>
                        <h4><span>Compensation and Benefits</span></h4>
                        <ul>
                            <li><span>Salary</span> <br> Your consolidated remuneration is listed in Annexure I. </li>
                            <li> <span>Increments and Promotions </span> <br>
                                Your next revision shall be in accordance with the Annual Performance Review cycle and
                                at the
                                sole
                                discretion of the Management.
                            </li>
                            <li> <span>Leave </span><br>
                                You will be eligible to the leaves as per the Leave Management Policy of the Company
                                upon
                                confirmation of your service.
                            </li>
                        </ul>
            </div>
        </div>
        <div class="page-break" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/HR Generalist.svg" alt="" style="width:100%;">
            <div class="sheet1">
                <ul>
                        <li> <span>Unauthorized Absence</span><br>
                            Your unauthorized absence (or overstay after sanctioned leave) for a continuous period
                            of three
                            working days shall be deemed to be voluntary abandonment of service at the option of the
                            Management
                            with no full and final settlement including salary
                        </li>
                        <li> <span>Travel Expenses</span><br>
                            You may be required to travel on Company business as and when required. In such cases,
                            you will
                            be
                            entitled to such travel expenses/allowances as per Company policies that are in force
                            from time
                            to
                            time.
                        </li>
                        <li><span>Other Compensation</span><br>The Company may decide to award employees for either
                            their
                            performance or the Company’s overall performance, as judged by the management from time
                            to time.
                            Decisions of the management on such an award shall be at its sole discretion and
                            non-negotiable.
                            Further, you shall remain ineligible for any such award until you are on probation.
                        </li>
                    </ul>
                
                        <h4><span>Miscellaneous</span></h4>
                        <ul>
                            <li><span>Working Hours</span><br>You will be required to work 8 hours a day excluding one
                                hour (1:00 hrs) break for lunch. The Company practices a 48 hours work week. Subject to the
                                applicable law, work timings, schedules and shifts may vary from time to time based on
                                your job
                                and depending upon exigencies of business, as specified by the Company from time to
                                time. You
                                may be required to work additional hours as appropriate to fulfill the responsibilities
                                of your
                                role.</li>
                            <li><span>Taxation</span><br>Any amount payable by the Company to you towards Compensation,
                                Other
                                Entitlements and, or, any other payment shall be subject to deduction of withholding
                                taxes and,
                                or, any other taxes under applicable law. All requirements under Indian tax laws,
                                including tax
                                compliance and filing of tax returns, assessment etc. of your personal income, shall be
                                fulfilled by you.
                            </li>
                            <li><span>No Other Employment or Vocation</span><br>During your employment with the Company
                                and till
                                the Company issues a relieving certificate to you upon termination, you shall not take
                                up or
                                continue any other employment or vocation, paid or unpaid.
                            </li>
                            <li><span>Disclosure and Verification</span><br>The position in which you are appointed is
                            one of
                            utmost confidence, trust and requires a high degree of integrity. Your appointment,
                            therefore,
                            is subject to verification and continuation of such confidence. In addition, it is
                            expected that
                            before accepting this offer, you shall voluntarily disclose to the Company any relevant
                            information in full.
                        </li>
                        </ul>
            </div>
    </div>
        <div class="page-break" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/HR Generalist.svg" alt="" style="width:100%;">
            <div class="sheet1">
                <ul>
                        <li><span>Confidential Information</span><br>
                            For the purposes of this Agreement, 'Confidential Information' in relation to the
                            includes but
                            is not restricted to the following:
                        </li>
                        <li>Trade Secrets; or<br>
    
                        </li>
                        <li> Lists or details of the Company’s suppliers, vendor, affiliated corporates, placement
                            partners,
                            government contacts; or
                        </li>
                        <li>Marketing Plan, Revenue Forecasts, Lists of Assets, including land banks, machinery
                            etc.; or
                        </li>
                        <li>Any proposals relating to the future of Company or any of its business or any part
                            thereof.; or
                        </li>
                        <li>Details of its employees and officers and of the remuneration and other benefits paid to
                            them;
                            or</li>
                        <li>Information relating to business matters, corporate plans, management systems,
                            investments,
                            finances, accounts, marketing or sales of any past, present or future products or
                            service,
                            processes, inventions, designs, knowhow, discoveries, technical/financial specifications
                            and
                            other technical or financial information relating to the creation, production or supply
                            of any
                            past, present or future products or service of the Company, any information given to the
                            Company
                            in confidence by clients/customers, suppliers or other persons and any other information
                            (whether or not recorded in documentary form, or a computer file) which is confidential
                            or
                            commercially sensitive and is not in the public domain; or</li>
                        <li>
                            Any other information which is notified to you as confidential. <br>
                            You shall not, either during your employment or at any time thereafter, except as
                            required by
                            law, use, divulge or disclose to any person any Confidential Information, which may have
                            come to
                            your knowledge at any time during the course of your employment with the Company. This
                            clause
                            will continue to apply to information which you may believe has entered the public
                            domain other
                            than (directly or indirectly) through your act, omission, negligence or fault.
                        </li>
                    </ul>
                    <h4><span>Intellectual Property</span></h4>
                        <ul>
                            <li>
                                You acknowledge that the Company is the absolute, unrestricted and exclusive owner of
                                the
                                Confidential Information or other proprietary technical, financial, marketing,
                                manufacturing,
                                construction, distribution or other business related information or trade secrets of the
                                Company, including without limitation, concepts, techniques, processes, methods,
                                systems,
                                designs, clients, cost data, computer programs, formulae, machinery, equipment and other
                                information used by you in course of your employment with the Company. You shall not in
                                any
                                manner whatsoever, represent and/or claim that you have any interest by way of
                                ownership,
                                assignment, rights or otherwise in the same.
                            </li>
                        </ul>
            </div>
    </div>
        <div class="page-break" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/HR Generalist.svg" alt="" style="width:100%;">
            <div class="sheet1">
                <ul>
                        <li>
                                You acknowledge that the Company shall own all rights, title and interest in any work
                                done by
                                you in course of your employment with the Company. You agree to irrevocably and
                                unconditionally
                                assign to the Company all your rights, title and interest in such works for adequate
                                consideration, receipt whereof you hereby acknowledge. You agree to execute such other
                                documents, as may be required by the Company, for recording the Company as the owner of
                                such
                                works at the Company's cost and expense.
                            </li>
                            <li>All intellectual property shall always be considered as ‘Confidential’ as per above
                                clause.</li>
                </ul>
                <h4><span>Termination</span></h4>
                        <ul>
                            <li>
                                <h5>Without Cause</h5>
                                <ul>
                                    <li>During the Probation Period Company may terminate this Agreement without
                                        assigning any
                                        reasons upon seven (7) days prior notice in writing or payment by you to the
                                        Company of
                                        the salary in lieu thereof. In such an event and in addition to the seven (7)
                                        days
                                        written notice or salary in lieu thereof, you shall also be liable to reimburse
                                        to the
                                        Company any joining bonus, rent, training costs etc. paid to/for you by the
                                        Company.
                                    </li>
                                    <li>Upon your confirmation as an employee, Company may terminate this Agreement
                                        without
                                        assigning any reasons upon thirty (30) days prior notice in writing by Company
                                        to you of
                                        the salary in lieu thereof. In such an event and in addition to the thirty (30)
                                        days
                                        written notice or salary in lieu thereof, you shall also be liable to reimburse
                                        to the
                                        Company any joining bonus, rent, Training costs etc. paid to/for you by the
                                        Company.
                                    </li>
                                    <li>
                                        In case of termination of employment, you may be required to go on a paid/unpaid
                                        leave
                                        until the end of your notice period at the Company's discretion, which may be
                                        adjusted
                                        against your leave entitlement, if any, that has accrued and not been taken.
                                    </li>
                                    <li>You shall not be entitled to any leave while serving your notice period under
                                        this
                                        Agreement.
                                    </li>
                                    <li>
                                        The organisation can do background verification anytime during the working tenure, if, during a background check, the organisation discovers any unethical behaviour or a significant discrepancy in the documents submitted by the candidate, it may have grounds to terminate the employment contract.
                                    </li>
                                </ul>
                            </li>
                            <li>
                            <h4><span>Breach or Misconduct</span></h4>
                            Notwithstanding anything herein, the Company shall be entitled
                            to
                            terminate this Agreement, without notice and with immediate effect, in the event you
                            are:
                            </li>
                            <ul>
                                <li>found to have engaged in any act of misconduct or negligence in the discharge of
                                    your
                                    duties or in the conduct of the Company's business; or</li>
                                    <li>During probation, the Company may terminate this Agreement without assigning any
                                    reasons
                                    upon seven (7) days prior notice in writing or payment by you to the Company of
                                    the
                                    salary in lieu thereof, at the discretion of the Company.</li>
                            </ul>
                        </ul>
            </div>
    </div>
        <div class="page-break" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/HR Generalist.svg" alt="" style="width:100%;">
            <div class="sheet1">
                    <ul>
                        <ul>
                                
                                <li>found to have engaged in any other act or omission, inconsistent with your
                                    duties,
                                    KRA(s) and KPI(s); or found to have engaged in corrupt practices; or found to
                                    have
                                    misbehaved with someone or represent the Company in poor light to either vendors
                                    /
                                    affiliates / people / officials; or found to have engaged in any breach of this
                                    Agreement, or the Company Policy or lawful orders given to you by the Company;
                                    or
                                    convicted or charged of any criminal offense; or failed to disclose any relevant
                                    information pertaining to your background; or found to have engaged in
                                    unauthorized
                                    absence from work.
                                    The Company may decide to forfeit any dues towards you, including salary, v
                                    entitled
                                    payments, bonus, other benefits like telephone & rent payments etc. if you are
                                    terminated under the abovementioned clause. The Company may also claim damages
                                    from you
                                    that you shall pay to the Company depending upon the nature of your act.</li>
                                <li>Post confirmation, the Company may terminate this Agreement without assigning
                                    any
                                    reasons upon thirty (30) days prior notice in writing or payment by you to the
                                    Company
                                    of the salary in lieu thereof, at the discretion of the Company.</li>
                            </ul>
                        <li>
                            <h4><span>Leave</span></h4>
                            <ul>
                                <li>If upon termination you have taken more leaves than your entitlement, you will be
                            required to
                            reimburse the Company in respect of the excess days taken and the Company is authorized
                            to make
                            deductions in respect of the same from your final salary payment. In the event such
                            deductions
                            exceed the final salary payment to you, you shall pay such outstanding amount to the
                            Company.</li>
                            </ul>
                        </li>
                        <li>
                            <h4><span>Company Property</span></h4>
                            <ul>
                                <li>For the purposes of this Paragraph, Property means keys, vehicles, any mobile
                                    phone,
                                    computer equipment, any other electronic equipment, registers, pens, stamps, any
                                    material issued in your name by the store, all lists of clients or customers,
                                    correspondence and all other documents, files, papers and records (including,
                                    without
                                    limitation, any records stored or maintained in any form including by electronic
                                    means,
                                    together with any codes or passwords or implements necessary to give full access
                                    to such
                                    records), system designs, software designs, software programs (in whatever
                                    media),
                                    presentations, proposals, specifications, intellectual property or Confidential
                                    Information which may have been prepared by you or have come into or passed from
                                    your
                                    possession, custody or control in the course of your employment.</li>
                                <li>
                                    Employees are responsible for properly handling the employer's property
                                    entrusted to
                                    them. Employees can be held liable to pay for any damage caused to the Company
                                    property.
                                </li>
                            </ul>
                        </li>
                    </ul>
            </div>
    </div>
        <div class="page-break" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/HR Generalist.svg" alt="" style="width:100%;">
            <div class="sheet1">
                <ul>
                    <ul>
                        <li>You shall promptly, whenever requested by the Company or upon receipt of notice
                                    of
                                    termination or termination of employment, deliver to the Company all Property
                                    and you
                                    shall not retain any copies thereof. Title and copyright in the Property shall
                                    vest in
                                    the Company. Failure to do so may invite civil / criminal proceedings against
                                    you by the
                                    Company.</li>
                        <li>During employment, as also after leaving the company, you undertake not to
                                    solicit, in
                                    any way directly or indirectly in the behavior inducing, any affiliates or
                                    employees of
                                    the Company to discontinue or adversely change their relationship/employment
                                    with the
                                    Company.</li>
                    </ul>
                    <li>
                            <h4><span>Governing Law</span></h4>
                            This Agreement shall be governed and construed in
                            accordance
                            with the
                            laws of India. The invalidity or unenforceability of any part of this Agreement shall
                            not affect
                            the binding effect of the rest of the Agreement. Any dispute arising out of this
                            agreement shall
                            be subject to jurisdiction of courts at Delhi alone.
                        </li>
                        <li>
                        <h4><span>Conduct</span></h4>
                        Your appointment requires from you supervisory responsibilities and representation externally
                        during the
                        course of your employment. You should be aware of these responsibilities and will conduct
                        yourself
                        accordingly including with professionalism.Your appointment shall be concluded and effective on your delivering a signed copy of this
                        letter to
                        us,
                        provided that your Compensation and Other Entitlements shall not begin to accrue until you commence
                        work for
                        the Company.For the purpose of preventing the unauthorized disclosure of Confidential Information, you agree
                        to
                        enter
                        into a confidential relationship with the Company. Please find enclosed the copy of the Non
                        Disclosure
                        Agreement. You are requested to sign the same and return it to the HR at the time of joining.
                        If the terms and conditions of this offer letter are acceptable to you, please signify your
                        acceptance by
                        signing and returning a copy of this letter to the Company within 3 days from the date on the top of
                        this
                        letter, failing which, this offer stands automatically withdrawn by the Company without any further
                        notice
                        to you.
                        We are pleased to welcome you to Pantheon Digital Private Limited. We look forward to a mutually
                        benefitting
                        association.
                    </li>
                </ul>
                <h4 class="text-center"><span>ACCEPTED</span></h4>
                <p>I have read, understood and agree to the terms and conditions as set out in this Appointment letter.</p>
                <p class="my-4"> Employee Signature:</p>
                <p class="my-4">Employee Name:</p>
            </div>
    </div>
        <div class="page-break" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/HR Generalist.svg" alt="" style="width:100%;">
            <div class="sheet1">
                <h4 class="text-center"><span>Employee Non-Disclosure Agreement</span></h4>
                <br>
                <p>This Agreement (the "Agreement") is executed between M/s Pantheon Digital Private Limited (hereafter
                    referred to as "Company") {{$ext['fname']}} {{$ext['lname']}}, (Hereafter referred to as "Employee") on {{$ext['jdate']}}. In consideration of the employee’s continued employment with the company, the parties agree on
                    the following points: -</p>
                <ul>
                    <li><h4><span>Intellectual Property</span></h4><br>Any resources obtained by you from the Company, or
                        any work created by the
                        you during your tenure at the Company using any of the Company’s resources in any quantum, or any
                        work that he / she might have contributed to or recorded or reviewed or heard about, or any reward /
                        award / affiliation / position obtained on account of the ongoing relationship with the Company, are
                        solely and undeniably the intellectual property of the Company in perpetuity. You will have no right
                        to use it, reproduce it, recite it or repeat it outside of the Company or after termination of the
                        relationship / employment with the Company. Any use must be authorized only by the Company and any
                        violation of this will amount to penalties, not less than the quantifiable past & projected value of
                        loss incurred by the Company on account of the action or five years of cost to the company of your
                        employment, whichever is higher.
                    </li>
                    <li><h4><span>Non-Disclosure Agreement</span></h4><br> You agree that during your employment or after
                        the
                        termination of the employment till perpetuity, you will have no right to disclose any information
                        regarding any Intellectual Property of the Company, any strategies of the Company, any tie-ups /
                        affiliations of the Company, contact information of key people at Company or its partners, its
                        pedagogy, its technology or any information concerning company's business, including cost
                        information, profits, sales information, accounting and unpublished financial information, business
                        plans, markets and marketing methods, customer lists and customer information, purchasing
                        techniques, supplier lists and supplier information or advertising strategies, to anyone not
                        specifically authorized by Company to be informed of the same. Any disclosure must be authorized and
                        any violation of this will amount to penalties, not less than the quantifiable past & projected
                        value of loss incurred by the Company on account of the action or five years of cost to the company
                        of the employment, whichever is higher.</li>
                </ul>
            </div>
    </div>
        <div class="page-break" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/HR Generalist.svg" alt="" style="width:100%;">
            <div class="sheet1">
                <ul>
                    <li><h4><span>Non-Compete Agreement</span></h4><br>You agree and fully understand that you will be
                        working in
                        an environment where you will have access to lots of proprietary & confidential information &
                        data as well as some intellectual property of the Company. You, out of your own volition, is
                        agreeing to work with the Company while giving an undertaking that you will not, under any
                        circumstances, join & / or collaborate with & / or partner with & / or contribute to & / or be
                        affiliated with in any capacity any organization that competes with the Company, or compete
                        directly him/herself in any of its business verticals for at least 12 months from the date of
                        termination of employment at Pantheon Digital Private Limited. Any such act must be authorized
                        and any violation of this will amount to penalties, not less than the quantifiable past and
                        projected value of loss incurred by the Company on account of the action or five years of cost
                        to company of the employee, whichever is higher
                    </li>
                </ul><br>
                <h4 class="text-center"><span>ACCEPTED</span></h4>
                <p>I have read, understood and agreed to the terms and conditions as set out in this Agreement.</p>
                <p class="my-4"> Employee Signature:</p>
                <p class="my-4">Employee Name:</p>
            </div>
    </div>
        <div class="page-break" style="position: relative; border: 1px solid;">
            <img src="{{env('APP_URL')}}public/HR Generalist.svg" alt="" style="width:100%;">
            <div class="sheet1" style="width:100%;">
                <h4 class="text-center"><span>ANNEXURE I</span></h4>
                <p class="text-center">Your consolidated remuneration will be {{$ext['salary']}} which is inclusive of {{$sal}} per annum of fixed</p>
                <p class="text-center">Company's Pay tenure from first day of month till last day of the month.</p>
                <p class="text-center">This fixed remuneration amount can be bifurcated as under:</p>
    
    
    <h5 style="text-align: center; text-decoration: none !important; font-weight: 600; border: 1px solid; margin-bottom: 0;">SALARY <br> STRUCTURE</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Component</th>
                            <th>Break up: Gross Salary Per month</th>
                            <th>Break up : Gross Salary Per Year</th>
                        </tr>
                        <tr>
                            <th>A. Basic</th>
                            <td>{{($ext['salary'] / 100) * 40}}</td>
							<td>{{(($ext['salary'] * 12) / 100) * 40}}</td>
                        </tr>
                        <tr>
                            <th>B. HRA</th>
                            <td>{{(($ext['salary'] / 100) * 40) / 2}}</td>
							<td>{{ ( ( ($ext['salary'] * 12) / 100) * 40) / 2}}</td>
                        </tr>
                        <tr>
                            <th>C. Special Allowance</th>
                            <td>{{($ext['salary'] / 100) * 40}}</td>
							<td>{{(($ext['salary'] * 12) / 100) * 40}}</td>
                        </tr>
                        <tr>
                            <th>Net salary(A+B+C) </th>
                            <td>{{$ext['salary']}}</td>
                            <td>{{($ext['salary'] * 12)}}</td>
                        </tr>
                        @if($ext['pf'])
                        @php($upf = ((($ext['salary'] * 0.40) * 0.12) > 1800 ? 3600 : (($ext['salary'] * 0.40) * 0.12) + ($ext['salary'] * 0.40) * 0.13)))
                        @php($tupf = $upf)
                        <tr>
                            <th>PF deduction</th>
                            <td>{{$tupf}}</td>
							<td>{{$tupf*12}}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Cost To Company</th>
                            <td>{{$ext['salary']}}</td>
                            <td>{{$ext['salary']*12}}</td>
                        </tr>
                        <tr>
                            <th>In Hand</th>
                            <td>@if($ext['pf']){{$ext['salary']  - $tupf}}@else{{$ext['salary']}}@endif</td>
                            <td>@if($ext['pf']){{($ext['salary']  - $tupf )*12}}@else{{$ext['salary']*12}}@endif</td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-12">
                    <p><span style="font-weight:700">{{$ext['fname']}},</span> we are very excited about the opportunity to work together. As we have discussed,
                        this is an important point in our formative process. We are expanding our India-based
                        operations and feel you can make a significant contribution to this effort.
                    </p>
                    </div>
                    <!--<div class="col-12">-->
                    <!--    <p>Based on your performance and on an opportunity, we believe that we will be able to offer-->
                    <!--        you very attractive financial and professional development during the tenure.-->
                    <!--    </p>-->
                    <!--</div>-->
                    <div class="col-12">
                        <p>We have every hope that this will be the beginning of a long and successful career for you
                            with Pantheon Digital.
                        </p>
                    </div>
                    <div class="col-12">
                        <span style="font-weight:700;font-size: 13px;">Pantheon Digital Pvt. Ltd.</span>
                    </div>
                    <div class="col-8">
                        <p id="sign" class="sing" style="margin-bottom:0px;">{{$ext['sign']}}</p>
                        <p style="margin-bottom:0px;">{{$ext['sign_deg']}}</p>
                    </div>
                    <div class="col-4 d-flex flex-column justify-content-between">
                        <p style="margin-bottom:0px;">Signature:</p>
                        <p style="margin-bottom:0px;">Date:</p>
                    </div>
                </div>
            </div>
    </div>
    </div>
    <center style="
    z-index: 999999999999999999;
    position: absolute;
    right: 5%;
    top:0px;
">
        <button onclick="demoFromHTML()" id="send">Send</button>
    </center>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="http://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>
    <script>
        function demoFromHTML() {
            $('#send').html('sending...');
            kendo.drawing
                .drawDOM("#page-container",
                    {
                        forcePageBreak: ".page-break", // add this class to each element where you want manual page break
                        paperSize: "A4",
                        margin: { top: "0cm", bottom: "0cm", right: "0cm", left: "0cm" },
                        scale: 1,
                        height: 500,
                        template: $("#page-template").html(),
                        keepTogether: "#descTab01"
                    })
                .then(function (group) {

                    kendo.drawing.pdf.toBlob(group, function (blob) {
                        // You can now upload it to a server.
                        // This form simulates an <input type="file" name="pdfFile" />.
                        // var form = new FormData();
                        // form.append("pdfFile", blob);
                        // form.append("name", '{{$ext['fname']}}');
                        // form.append("email", '{{$ext['email']}}');

                        // var xhr = new XMLHttpRequest();
                        // xhr.onload = function() {
                        //     console.log(this.responseText);
                        //     $('#send').html('sent');
                        // }
                        // xhr.open("POST", "/api/offup", true);
                        // xhr.send(form);
                    });


                    kendo.drawing.pdf.saveAs(group, "{{$ext['fname']}}.pdf");
                });
        }
    </script>
</body>

</html>