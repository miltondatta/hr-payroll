<?php $this->load->view('backend/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/organogram.css">
<?php $this->load->view('backend/sidebar'); ?>
<main>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Organogram</h4></div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Organogram</a></li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-3">

                <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="card-title">Organogram View</h4>
                            </div>
                            <div class="card-body">
                                <div style="width:100%; height:1600px !important;" id="orgchart"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Card DATA-->
            </div>
        </div>
    </div>
</main>
<?php $this->load->view('backend/footer'); ?>
<script src="<?php echo base_url(); ?>assets/js/orgchart.js"></script>
<script>
    var chart = new OrgChart(document.getElementById("orgchart"), {
        template: "diva",
        enableSearch: true,
        expand: {
        nodes: [],
            allChildren: true
        },
        // mouseScrool: OrgChart.action.none,
        nodeBinding: {
            field_0: "name",
            field_1: "title",
            img_0: "img"
        },
        nodes: [
            { id: 1, name: "", title: "Chairman", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 2, pid: 1, name: "", title: "Vice Chairman", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 3, pid: 2, name: "", title: "Managing Director", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 4, pid: 3, name: "", title: "Director", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 5, pid: 3, name: "", title: "Director Accounts and Finance", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 6, pid: 3, name: "", title: "Director Foreign Affairs", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 7, pid: 3, name: "", title: "Technical Director", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 8, pid: 3, name: "", title: "Director - HR", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 9, pid: 4, name: "", title: "GM - Commercial", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 10, pid: 5, name: "", title: "GM - Accounts and Finance", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 11, pid: 10, name: "", title: "Manager Accounts", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 12, pid: 10, name: "", title: "Manager Finance", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 13, pid: 11, name: "", title: "Executive", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 14, pid: 12, name: "", title: "Executive", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 15, pid: 7, name: "", title: "CTO", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 16, pid: 15, name: "", title: "GM - Technical", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 17, pid: 16, name: "", title: "Manager Software Development", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 18, pid: 16, name: "", title: "Manager Network", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 19, pid: 16, name: "", title: "Manager Cyber Security", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 20, pid: 17, name: "", title: "Software Engineer", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 21, pid: 17, name: "", title: "Software Engineer", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 22, pid: 18, name: "", title: "Network Engineer", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 23, pid: 19, name: "", title: "Cyber Security Engineer", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 24, pid: 19, name: "", title: "Cyber Security Engineer", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 25, pid: 8, name: "", title: "GM - HR", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 26, pid: 25, name: "", title: "Manager Hr", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
            { id: 27, pid: 25, name: "", title: "Manager Logistics", img: "https://cdn.balkan.app/shared/empty-img-none.svg" },
        ]
    });
</script>

