var _webAPIURL = "http://localhost/advanced/backend/web/";

function postJSON(JSONString, ApiUrl, AjaxType, SuccessCallBack, ErrorCallBack, AsyncRequest) {
    $.ajax({
        type: AjaxType,
        data: JSONString,
        url: ApiUrl,
        controlType: "application/json",
        async: AsyncRequest,
        dataType: "json",
        success: SuccessCallBack,
        error: ErrorCallBack
    });
}

function ErrorCallBack(error) {
    alert("Error Occured: " + JSON.stringify(error));
}

function ShowChildren(element) {
    debugger;
    var elementName = $(element).attr('id');
    var elementValue = $(element).val();

    elementName = elementName.toLowerCase();
    $('[data-child-' + elementName + ']').addClass('hide');

    if (elementValue != '') {
        var selectedText = $(element).find('option[value="' + elementValue + '"]').text();
        selectedText = selectedText.toLowerCase().replace(/ /g, '_');

        $('[data-child-' + elementName + '="' + selectedText + '"]').removeClass('hide');
    } 
}

function fillDropDown(jsonData, dropDownObject, valueColumn, textColumn) {
    var listItems = "";
    for (var i = 0; i < jsonData.length; i++) {
        listItems += "<option value='" + eval("jsonData[i]." + valueColumn) + "'>" + eval("jsonData[i]." + textColumn) + "</option>";
    }
    $("#" + dropDownObject).html(listItems);
}

function validateField(element) {
    var isValid = true;
    var value = element.val();
    var tagName = element.prop("tagName");

    if(!value || value == "")
        isValid = false;

    return isValid;
}


function showClientSideMessage(type, message) {
    var messageContainer = $('#ClientSideMessages');

    messageContainer.removeAttr('class');

    var classesToAdd = "alert";

    if(type == 'error') {
        classesToAdd += " alert-danger";
    } else {
        classesToAdd += " alert-success";
    }

    messageContainer.addClass(classesToAdd).text(message);

    setTimeout(function() {
        messageContainer.text('').removeAttr('class');
    }, 3000)
}
