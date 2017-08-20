/**
 * Sort list of tasks by parameter.
 * @param sortBy  Sort parameter.
 * @param page  Page number.
 * @param isAdmin  Is admin working with tasks.
 */
function sortTasksPager(sortBy, page, isAdmin) {
    $.get("index.php", {"method": "index", "page": page, 'sortBy': sortBy}, function (data) {
        $("table tbody").empty();
        //console.log(data);

        pagerUpdate(sortBy);

        for (var i = 0; i < data.length; i++) {
            $("table tbody").append("<tr>" +
                "<td>" + data[i].name + "</td>" +
                "<td>" + data[i].email + "</td>" +
                "<td>" + data[i].text + "</td>" +
                "<td>" + (data[i].done == 'yes' ? 'Да' : 'Нет') + "</td>" +
                "<td><img src='" + data[i].imgUrl + "' alt='' /></td>");

            if (isAdmin == true) {
                $("table tbody")
                    .append("<td><a href='/index.php?method=taskedit&id=" + data[i].id + "'>Редактировать</a></td>");
            }
        }
    }, 'json');
}

function pagerUpdate(sortBy)
{
    $("#pages").find("a").each(function(){
        var h = $(this).attr("href").split("sortBy");
        var url = h[0];
        url = url + "sortBy=" + sortBy;
        $(this).attr("href", url);
    });
}