//dynamically loads node information on page and sets active attribute in node tree.
function loadNode(element) {
    var elementUid = element.dataset.uid;
    $.ajax({
        url: '../scripts/displayNode.script.php',
        type: 'POST',
        dataType: 'html',
        data: {uid: elementUid},
        success: function (result){
            let elementNode = document.getElementsByClassName('node')[0];
            elementNode.innerHTML = result;
            $(".tree-node").removeAttr('id');
            let uidSelector = "[data-uid=" + '"' + elementUid + '"' + "]";
            let treeNode = document.querySelector(uidSelector);
            treeNode.id = "active";
        }
    });
}

//prepares url with attribute and sends user to new item page.
function sendToNewItem(isChild) {
    const nodeUid = $("#active").data("uid");
    if (isChild) {
        const url = 'new-item.php?uid=' + nodeUid + '&isChild=' + isChild;
        window.location.href = url;
    }else {
        const url = 'new-item.php?uid=' + nodeUid;
        window.location.href = url;
    }
}

//using post method runs remove script which returns true or child message.
function removeNode() {
    const nodeUid = $("#active").data("uid");
    $.ajax({
        url: '../scripts/removeItem.script.php',
        type: 'POST',
        dataType: 'json',
        data: {uid: nodeUid},
        success: function (result){
            if (result.status == 'true'){
                location.reload();
            }else if(result.status == 'child'){
                alert("Error! Try removing child elements first.");
            }
        }
    });
}
// checks if node is selected and sends user to edit item page.
function editNode() {
    const nodeUid = $("#active").data("uid");
    if (nodeUid != null){
        const url = 'edit-item.php?uid=' + nodeUid;
        window.location.href = url;
    }else {
        alert("Please select a node!");
    }
}