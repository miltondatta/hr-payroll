<table id="data-table" data-page-length='10'
       class="display table dataTable table-striped table-bordered text-center">
    <thead>
    <tr>
        <th>Employee Name</th>
        <th>Designation</th>
        <th>Financial Year</th>
        <th>Appraisal Category</th>
        <th>Rating Text</th>
        <th>Rating Value</th>
        <th>Created At</th>
    </tr>
    </thead>
    <tbody class="text-center">
    <?php foreach($appraisal_employee_data as $value): ?>
        <tr>
            <td><?php echo $value->first_name . ' ' . $value->last_name; ?></td>
            <td><?php echo $value->des_name; ?></td>
            <td><?php echo $value->financial_year; ?></td>
            <td><?php echo $value->category_name; ?></td>
            <td><?php echo $value->category_rating; ?></td>
            <td><?php echo $value->category_value; ?></td>
            <td><?php echo date_format(date_create($value->created_at),
                                       'Y-m-d H:i:s'); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>