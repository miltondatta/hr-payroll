<table id="data_table_example"
       class="display table dataTable table-striped table-bordered text-center">
    <thead>
    <tr>
        <th>Employee ID</th>
        <th>Employee Name</th>
        <th>Department</th>
        <th>Title</th>
        <th>Description</th>
        <th>Notice Date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($desciplinary as $value): ?>
        <tr>
            <td><?php echo $value->em_code; ?></td>
            <td><?php echo $value->first_name . ' ' . $value->last_name; ?></td>
            <td><?php echo $value->dep_name; ?></td>
            <td><?php echo substr("$value->title", 0, 15) . '...' ?></td>
            <td><?php echo substr("$value->description", 0, 10) . '...' ?> </td>
            <td><?php echo $value->notice_date; ?></td>
            <td>
                <button class="btn btn-sm btn-success"><?php echo $value->action; ?></button>
            </td>
            <td class="jsgrid-align-center ">
                <a href="#" title="Edit"
                   class="btn btn-sm btn-info waves-effect waves-light disiplinary"
                   data-id="<?php echo $value->id; ?>"><i
                            class="fa fa-pen" onclick="editDisiplinary('<?php echo $value->id; ?>')"></i></a>
                <a href="DeletDisiplinary?D=<?php echo $value->id; ?>"
                   onclick="if (!confirm('Are you sure want to delete this value?')) {return false;} "
                   title="Delete"
                   class="btn btn-sm btn-danger waves-effect waves-light"><i
                            class="far fa-trash-alt"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>