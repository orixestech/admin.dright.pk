<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">

<div class="card">
    <div class="card-body">
        <h4>Discounts Center Offers
            <span style="float: right;">
                <button type="button" onclick="AddDiscountOffer(<?=$UID?>)"
                        class="btn btn-primary "
                        data-toggle="modal" data-target="#exampleModal">
              Add
            </button>
           </span></h4>
    </div>
    <div class="table-responsive">
        <table id="frutis" class="table table-striped table-bordered">
            <thead>        <tr>
                <th width="80">Sr. No</th>
                <th>Group</th>
                <th>Service Name</th>
                <th>Current Price</th>
                <th>Basic Discount</th>
                <th>Premium Discount</th>
                <th width="180">Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th width="80">Sr. No</th>
                <th>Group</th>
                <th>Service Name</th>
                <th>Current Price</th>
                <th>Basic Discount</th>
                <th>Premium Discount</th>
                <th width="180">Actions</th>
            </tr>
            <div class="mt-4" id="Response"></div>

            </tfoot>
        </table>
    </div>
    <?php echo view('discount/modal/add_offer'); ?>
    <?php echo view('discount/modal/update_offer'); ?>
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
                    "url": "<?= $path ?>discount/fetch_discount_offer",
                    "type": "POST",
                    data: {
                        UID: '<?=$UID?>' // Wrap UID in quotes for string data
                    }
                }
            });});

    </script>
    <script>
        function AddDiscountOffer(id) {
            $('#AddDiscountOfferModal form#AddDiscountOfferForm input#DiscountCenterID').val(id);
            $('#AddDiscountOfferModal').modal('show');

        }
     

        function EditDiscountCenterOffer(id,discountid) {
            var Items = AjaxResponse("discount/get_record_discount_offer", "id=" + id);

            $('#UpdateDiscountOfferModal form#UpdateDiscountOfferForm input#UID').val(Items.record.UID);
            $('#UpdateDiscountOfferModal form#UpdateDiscountOfferForm input#CurrentPrice').val(Items.record.CurrentPrice);
            $('#UpdateDiscountOfferModal form#UpdateDiscountOfferForm input#DiscountCenterID').val(discountid);
            $('#UpdateDiscountOfferModal form#UpdateDiscountOfferForm input#BasicDiscount').val(Items.record.BasicDiscount);
            $('#UpdateDiscountOfferModal form#UpdateDiscountOfferForm input#PremiumDiscount').val(Items.record.PremiumDiscount);
            $('#UpdateDiscountOfferModal form#UpdateDiscountOfferForm input#ServiceName').val(Items.record.ServiceName);
            $('#UpdateDiscountOfferModal form#UpdateDiscountOfferForm select#Group').val(Items.record.Group);
            $('#UpdateDiscountOfferModal').modal('show');
        }

        function DeleteDiscountCenterOffer(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("discount/delete_discount_center_offers", "id=" + id);
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
