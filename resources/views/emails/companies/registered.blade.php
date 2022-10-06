<style>
    .container {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px 10px 20px 10px;
        background: #f6f6f6;
        font-family: sans-serif;
        overflow: auto;
    }
    .container table {
        width: 100%;
        background-color: #eaeaea;
        border: 1px solid #dbdbdb;
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>

<div class="container">
    <div class="wrapper">
        <div style="padding: 8px 0 10px 0">New Company Registered: <strong> {{ $company['name'] }} </strong></div>

        <table cellspacing="6px" align="left">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td> {{ $company['name'] }} </td>
                <td> {{ $company['email'] }} </td>
                <td> {{ \Carbon\Carbon::parse($company['created_at'])->format('Y-m-d') }} </td>
            </tr>
            </tbody>
        </table>

        Regards,<br>
        {{ config('app.name') }}
    </div>
</div>
