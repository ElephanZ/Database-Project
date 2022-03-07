var checkWhichChecked = () => {
    let result = 0;

    if ($('#finished_cb').is(':checked') && $('#active_cb').is(':checked')) result = 1;
    else if ($('#finished_cb').is(':checked')) result = 2;
    else if ($('#active_cb').is(':checked')) result = 3;

    return result;
};

var getData = (id) => {
    $.ajax({
        method: 'post',
        url: 'src/php/api/getOperations.php',
        data: 'operation=' + id,
        dataType: 'json',
        success: (res) => {
            $('.table tbody').empty();
            addRowsToTable(res);
        }
    });
};

var delivery = (operation) => {
    let id = $(operation).attr('id').split('-')[1];
    $.ajax({
        method: 'post',
        url: 'src/php/api/delivery.php',
        data: 'operation=' + id,
        dataType: 'json',
        success: () => {
            location.reload();
        }
    });
};

var addRowsToTable = (data) => {
    for (let idx in data) {
        
       $("table tbody").append(
            "<tr>" +
            "<td>" + data[idx]['id'] + "</td>" +
            "<td>" + data[idx]['sn'] + " " + data[idx]['brand'] + " " + data[idx]['model'] + "</td>" +
            "<td>" + data[idx]['client_id'] + "</td>" +
            "<td><b>W: </b>" + data[idx]['wall'] + ", <b>R: </b>" + data[idx]['row'] + ", <b>C: </b>" + data[idx]['colmn'] + "</td>" +
            "<td>" + data[idx]['date_pickup'] + "</td>" +
            "<td>" + (data[idx]['date_delivery'] == null ? " " : data[idx]['date_delivery']) + "</td>" +
            "<td>" + data[idx]['technician_id'] + "</td>" +
            "<td>" + parseFloat(data[idx]['total']).toFixed(2) + " &#128;</td>" +
            "<td>" + (data[idx]['date_delivery'] ? " " : "<i class='fa-solid fa-flag-checkered' id='finish-" + data[idx]['id'] + "' onclick='delivery(this)' title='Delivery!'></i>") +
            "</td>" +
            "</tr>"
        );

    }
};