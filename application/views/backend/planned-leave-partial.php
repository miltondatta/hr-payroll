<table id="data-table" data-page-length='10'
       class="display table dataTable table-striped table-bordered text-center">
    <thead>
    <tr>
        <th>Leave Type</th>
        <th>Leave From</th>
        <th>Leave To</th>
        <th>Remarks</th>
        <th>Added By</th>
        <th>Created At</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody class="text-center">
    <?php foreach ($planned_leave_data as $value): ?>
        <tr>
            <td><?php echo $value->leave_type_name ?></td>
            <td><?php echo $value->leave_from ?></td>
            <td><?php echo $value->leave_to ?></td>
            <td><?php echo substr($value->remarks, 0, 50);
                echo strlen($value->remarks) > 50 ? '...' : ''; ?></td>
            <td><?php echo $value->added_by ?></td>
            <td><?php echo date_format(date_create($value->created_at), 'Y-m-d H:i:s'); ?></td>
            <td>
                <a href="javascript:void(0);" class="btn btn-info rounded-btn"
                   onclick="getPlannedLeaveInfoById(<?php echo $value->id; ?>)">
                    Edit
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>