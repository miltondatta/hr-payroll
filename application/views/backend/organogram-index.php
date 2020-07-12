<?php $this->load->view('backend/header'); ?>
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
                                <div id="myDiagramDiv" style="width: 100%; height: 350px; background-color: #DAE4E4;"></div>
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
<script src="https://unpkg.com/gojs/release/go-debug.js"></script>
<script>
    var $ = go.GraphObject.make;

    var myDiagram =
        $(go.Diagram, "myDiagramDiv",
            {
                "undoManager.isEnabled": true,
                layout: $(go.TreeLayout,
                    { angle: 90, layerSpacing: 35 })
            });

    // the template we defined earlier
    myDiagram.nodeTemplate =
        $(go.Node, "Horizontal",
            { background: "#44CCFF" },
            $(go.TextBlock, "Default Text",
                { margin: 12, stroke: "white", font: "bold 16px sans-serif" },
                new go.Binding("text", "name"))
        );

    // define a Link template that routes orthogonally, with no arrowhead
    myDiagram.linkTemplate =
        $(go.Link,
            { routing: go.Link.Orthogonal, corner: 5 },
            $(go.Shape, // the link's path shape
                { strokeWidth: 3, stroke: "#555" }));

    var model = $(go.TreeModel);
    model.nodeDataArray =
        [
            { key: "1",              name: "Ceo"},
            { key: "2", parent: "1", name: "Vice President Finance"},
            { key: "3", parent: "2", name: "Chief Accountant"},
            { key: "4", parent: "2", name: "Chief Accountant"},
            { key: "5", parent: "4", name: "Junior Accountant"},
            { key: "6", parent: "1", name: "Vice President Marketing"},
            { key: "7", parent: "6", name: "Sales Manager"},
            { key: "8", parent: "6", name: "Advertising Manager"},
            { key: "9", parent: "8", name: "Account Executive"},
            { key: "10", parent: "1", name: "Vice President HR"},
            { key: "11", parent: "10", name: "Hr Manager"},
            { key: "12", parent: "10", name: "Recruit Executive"},
            { key: "13", parent: "1", name: "Chief Technical Officer"},
            { key: "14", parent: "13", name: "Project Manager"},
            { key: "15", parent: "14", name: "Software Developer"}
        ];
    myDiagram.model = model;
</script>
