<?php include "./modals/product-creator.php"; ?>


<section class="products_editor">

    <a href="#modal-product-creator" class="button button__link">Crear Producto</a>

    <section id="products-table-container">

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

    table {

        margin: 1rem;
    }

    table,
    th,
    td {
        padding: 12px;
        border: 1px solid black;
        border-collapse: collapse;

        place-items: center;
        justify-content: center;
        text-align: center;
    }

    .actions {
        display: flex;
        flex-direction: row;
        gap: 8px;
    }

    #products-table-container {
        display: flex;
        width: 100%;
        flex-direction: column;

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

    selectData("*", "products", "", (data) => {
        renderProductsTable(data)
    })



    function renderProductsTable(products) {
        let tableHtml = "<table><thead><tr>";
        let columns = Object.keys(products[0]);

        columns.forEach(column => {
            tableHtml += `<th>${capitalizeFirstLetter(column)}</th>`;
        });

        tableHtml += "<th>Acciones</th></tr></thead><tbody>";

        products.forEach(product => {
            tableHtml += "<tr>";
            columns.forEach(column => {
                tableHtml += `<td>${htmlspecialchars(product[column]) }</td>`;
            });
            tableHtml += `
                <td class="actions">
                    <button class="edit-btn">Editar</button>
                    <button class="delete-btn danger">Eliminar</button>
                </td>
            </tr>`;
        });

        tableHtml += "</tbody></table>";

        $("#products-table-container").html(tableHtml);
    }
</script>