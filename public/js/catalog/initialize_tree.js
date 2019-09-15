$(document).ready(function() {
    adaptToPlugin(catalogsTree);

    const treeElement = $('#tree');
    const documentView = $('.document-view');
    treeElement
        .treeview({data: catalogsTree})
        .on('nodeSelected', function(event, catalog) {
            documentView.empty();
            for(let document of catalog['documents']){
                documentView.append('<li class="list-group-item">' + document.name + '</li>');
            }
        });
});