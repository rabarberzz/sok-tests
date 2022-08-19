
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