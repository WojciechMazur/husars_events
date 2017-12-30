import * as $ from "jquery";
export function stringToDate(_date,_format)
{
    const delimiter = /[ :-]/;
    const formatLowerCase = _format.toLowerCase();
    const formatItems = formatLowerCase.split(delimiter);
    const dateItems = _date.split(delimiter);
    const monthIndex = formatItems.indexOf("mm");
    const dayIndex = formatItems.indexOf("dd");
    const yearIndex = formatItems.indexOf("yyyy");
    const hourIndex = formatItems.indexOf("hh");
    const minuteIndex = formatItems.indexOf("mm");
    const secondIndex = formatItems.indexOf("ss");
    let month = parseInt(dateItems[monthIndex]);
    month-=1;
    const date = new Date(dateItems[yearIndex],month,dateItems[dayIndex], dateItems[hourIndex], dateItems[minuteIndex], dateItems[secondIndex]);
    return(date);
}

export function findTextInTable(_search, _table){

    if (_table===undefined)
        _table="table";
    return $(`${_table} tr td`).filter(function () {
        return $(this).text()===_search
    }).closest("tr");

}

export function showMessage(message, color='black', fade_in=500, delay=1000, fade_out=500) {
    $('#message-text').css('color', color);
    $("#message-text").html(message).fadeIn(fade_in).delay(delay).fadeOut(fade_out);
}
