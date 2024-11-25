<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">


<div class="card">
    <div class="card-body">
        <h4>Sponser
            <span style="float: right;">
                <button type="button" onclick="AddSponser()"
                        class="btn btn-primary "
                        data-toggle="modal" data-target="#exampleModal">
              Add
            </button>
           </span></h4>

    </div>
    <div class="table-responsive">
        <table id="frutis" class="table table-striped table-bordered">
            <thead>            <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>OrderID</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>OrderID</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            <div class="mt-4" id="Response"></div>

            </tfoot>
        </table>
    </div>
    <?php echo view('builder/modal/add_sponser'); ?>
    <?php echo view('builder/modal/update_sponser'); ?>
    <script>
        $(document).ready(function (){
            $('#frutis').DataTable({
                "scrollY": "800px",
                "scrollCollapse": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "lengthMenu": [[100, 500, 1000, -1], [100, 500, 1000, 'All']],
                "pageLength": 100,
                "autoWidth": true,
                "ajax": {
                    "url": "<?= $path ?>builder/fetch_sponser",
                    "type": "POST"
                }
            });});

    </script>
    <script>
        function AddSponser() {
            $('#AddSponserModal').modal('show');

        }
        function SponserProduct(id) {
            location.href = "<?=$path?>builder/sponsor_product/" + id;
        }
        function UpdateSponser(id) {
            var Items = AjaxResponse("builder/get_sponser_record", "id=" + id);

            $('#UpdateSponsereModal form#UpdateSponserForm input#UID').val(Items.record.UID);
            $('#UpdateSponsereModal form#UpdateSponserForm input#Name').val(Items.record.Name);
            $('#UpdateSponsereModal form#UpdateSponserForm input#OrderID').val(Items.record.OrderID);

            var imageHTML;
            if (Items.record.Image) {
                imageHTML = '<img src="<?= load_image("mysql|sponsors| ") ?>' + Items.record.UID + '" style="display: block; padding: 2px; border: 1px solid #145388 !important; border-radius: 3px; width: 150px;" />';
            } else {
                imageHTML = '';
            }
            $('#UpdateSponsereModal form#UpdateSponserForm div#ImageHTML').html(imageHTML);
            $('#UpdateSponsereModal').modal('show');
        }

        function DeleteSponser(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("builder/delete_sponser", "id=" + id);
                if (response.status == 'success') {
                    $("#Response").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Deleted Successfully!</strong>  </div>')
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    $("#Response").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Error! Not Deleted</strong>  </div>')
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }

            }
        }

    </script>

    <script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
    <script src="<?= $template ?>assets/js/examples/datatable.js"></script>
    <script src="<?= $template ?>vendors/prism/prism.js"></script>
