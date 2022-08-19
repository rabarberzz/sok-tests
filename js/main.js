
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
