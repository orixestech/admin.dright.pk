<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">


<div class="card">
    <div class="card-body">
        <h4>Sponsor Product
            <span style="float: right;">
                <button type="button" onclick="AddSponserProduct(<?=$UID?>)"
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
                <th>Pack Size</th>
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
                <th>Pack Size</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            <div class="mt-4" id="Response"></div>

            </tfoot>
        </table>
    </div>
    <?php echo view('builder/modal/add_sponser_product'); ?>
    <?php echo view('builder/modal/update_sponser_product'); ?>
    <script>
        $(document).ready(function () {
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
                    "url": "<?= $path ?>builder/fetch_sponsor_product",
                    "type": "POST",
                    data: {
                        UID: '<?=$UID?>' // Wrap UID in quotes for string data
                    }
                }
            });
        });

    </script>
    <script>
        function AddSponserProduct(id) {
            $('#AddSponserProductModal form#AddSponserProductForm input#SponsorID').val(id);

            $('#AddSponserProductModal').modal('show');

        }

        function UpdateSponsorProduct(id,spid) {
            var Items = AjaxResponse("builder/get_sponser_product_record", "id=" + id);
            $('#UpdateSponsereProductModal form#UpdateSponserProductForm input#SponsorID').val(spid);

            $('#UpdateSponsereProductModal form#UpdateSponserProductForm input#UID').val(Items.record.UID);
            $('#UpdateSponsereProductModal form#UpdateSponserProductForm input#Name').val(Items.record.Name);
            $('#UpdateSponsereProductModal form#UpdateSponserProductForm input#GenericName').val(Items.record.GenericName);
            $('#UpdateSponsereProductModal form#UpdateSponserProductForm input#TherapeuticSegments').val(Items.record.TherapeuticSegments);
            $('#UpdateSponsereProductModal form#UpdateSponserProductForm input#MRP').val(Items.record.MRP);
            $('#UpdateSponsereProductModal form#UpdateSponserProductForm input#PackSize').val(Items.record.PackSize);
            $('#UpdateSponsereProductModal form#UpdateSponserProductForm input#TP').val(Items.record.TP);
            $('#UpdateSponsereProductModal form#UpdateSponserProductForm input#EFP').val(Items.record.EFP);
            $('#UpdateSponsereProductModal form#UpdateSponserProductForm input#Orderid').val(Items.record.Orderid);
          $('#UpdateSponsereProductModal').modal('show');
        }

        function DeleteSponserProduct(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("builder/delete_sponser_product", "id=" + id);
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
