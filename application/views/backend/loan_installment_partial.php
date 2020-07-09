<table id="data-table" data-page-length='10'
       class="display table dataTable table-striped table-bordered text-center">
    <thead>
    <tr>
        <th>Employee PIN</th>
        <th>Loan Id</th>
        <th>Loan Number</th>
        <th>Install Amount</th>
        <th>Approve Date</th>
        <th>Receiver</th>
        <th>Install No</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody class="text-center">
    <?php foreach($installment as $value): ?>
        <tr>
            <td><?php echo $value->em_code ?></td>
            <td><?php echo $value->loan_id ?></td>
            <td><?php echo $value->loan_number ?></td>
            <td><?php echo $value->install_amount ?></td>
            <td><?php echo date('jS \of F Y', strtotime($value->app_date)); ?></td>
            <td><?php echo $value->receiver ?></td>
            <td><?php echo $value->install_no ?></td>
            <td>
                <button class="btn btn-primary rounded-btn"
                        onclick="installmentEdit(<?php echo $value->id ?>)">
                    <i class="fa fa-edit"></i>
                </button>
                <a onclick="return confirm('Are you sure to delete this data?')"
                   href="<?php echo base_url(); ?>loan/delete_installment/<?php echo $value->id; ?>"
                   class="btn btn-danger rounded-btn">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>