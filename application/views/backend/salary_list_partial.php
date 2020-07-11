<table id="data_table_example"
       class="display table dataTable table-striped table-bordered">
    <thead>
    <tr>
        <th class="hide">SL</th>
        <th>PIN</th>
        <th>Employee</th>
        <th>Month</th>
        <th>Salary</th>
        <th>Loan</th>
        <th>Over Time</th>
        <th>Deduction</th>
        <th>Total Paid</th>
        <th>Pay Date</th>
        <th>Status</th>
        <th class="jsgrid-align-center">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 0;
    foreach($salary_info as $individual_info): ?>
        <tr>
            <td class="hide"><?php $i ++;
                echo $i; ?></td>
            <td><?php echo $individual_info->em_code; ?></td>
            <td><?php echo $individual_info->first_name . ' ' .
                           $individual_info->last_name; ?></td>
            <td><?php echo $individual_info->month . ' ' .
                           $individual_info->year; ?></td>
            <td><?php echo $individual_info->total_salary; ?></td>
            <td><?php echo $individual_info->loan; ?></td>
            <td><?php echo $individual_info->hourly_rate *
                           $individual_info->hours_worked; ?></td>
            <td><?php echo $individual_info->diduction; ?></td>
            <td><?php echo $individual_info->total_pay; ?></td>
            <td><?php echo $individual_info->paid_date; ?></td>
            <td><?php echo $individual_info->status; ?></td>
            <td class="jsgrid-align-center ">
                <a href="<?php echo base_url(); ?>payroll/invoice?Id=<?php echo $individual_info->pay_id; ?>&em=<?php echo $individual_info->emp_id; ?>"
                   title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i
                            class="fa fa-print"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>