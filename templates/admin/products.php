<?php include "./modals/product-creator.php"; ?>


<section class="products_editor">

    <a href="#modal-product-creator" class="button button__link">Crear Producto</a>

    <section id="products-table-container">
        <table id="products-table" class="stripe hover order-column row-border compact cell-border"></table>
    </section>


</section>



<style>
    .products_editor {
        display: flex;
        flex-direction: column;
        gap: 24px;
        padding: 2rem;
        margin: 0;
    }

    .products_editor>.button {
        display: flex;
        width: fit-content;
        color: black;
    }

    #products-table-container {
        display: flex;
        width: 100%;
        flex-direction: column;
        z-index: 0;

    }
</style>

<script defer>
    var active = false

    const openModalBtn = $(".products_editor .button")
    const modal = $("#modal-product-creator")

    modal.toggleClass("active", true)

    openModalBtn.on('click', () => {
        console.log("Open modal");
        console.log(modal)
    })

    $(document).ready(function() {
        selectData("*", "products", "", (data) => {
            console.log(data)

            if (data.length > 0) {

                $('#products-table').DataTable({
                    columns: Object.keys(data[0]).map((key) => {
                        return {
                            title: capitalizeFirstLetter(key)
                        }
                    }).concat({
                        title: "Actions"
                    }),
                    data: data.map((row) => {
                        return Object.values(row).concat("")
                    }),
                    columnsDef: [{
                            targets: 0,
                            visible: false,
                            searchable: false
                        },
                        {
                            targets: [2],
                            render: function(data, type, row) {
                                return (data === '0' || data === '0.00') ? '0' : $.fn.dataTable.render.number(',', '.', 2, '$', '').display(data)
                            }
                        },
                    ],

                });

            }
        });
    })
</script>