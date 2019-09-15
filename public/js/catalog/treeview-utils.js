'use strict';

function renameKey(object, oldKey, newKey) {
    if (oldKey !== newKey && object.hasOwnProperty(oldKey)) {
        Object.defineProperty(object, newKey,
            Object.getOwnPropertyDescriptor(object, oldKey));
        delete object[oldKey];
    }
}

function renameKeys(catalog) {
    renameKey(catalog, 'name', 'text');
    renameKey(catalog, '__children', 'nodes');
}

function adaptToPlugin(catalogs){
    for(let catalog of catalogs){

        if(catalog['__children'].length > 0){
            adaptToPlugin(catalog['__children']);
        }else{
            delete catalog['__children'];
        }

        if(catalog['documents'].length === 0){
            catalog.selectable = false;
        }

        renameKeys(catalog);
    }
}