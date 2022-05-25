$('#jstree').jstree({
    "core" : {
        "themes" : {
            "responsive": false
        },
        // so that create works
        "check_callback" : true,
        'multiple': false,
        // 'data': [{
        //         "text": "Winslots",
        //         "icon" : "fa fa-folder-open text-success",
        //          "state": {
        //             "selected": true
        //         },
        //         "children": [{
        //             "text": "Initially selected",
        //             "icon" : "mdi mdi-account text-success",
        //             "li_attr": { 'agent-id' : 1 }
        //             // "state": {
        //             //     "selected": true
        //             // }
        //         }, {
        //             "text": "Custom Icon",
        //             "icon": "mdi mdi-folder-account"
        //         }, {
        //             "text": "Initially open",
        //             "icon" : "mdi mdi-account-multiple text-success",
        //             "state": {
        //                 "opened": true
        //             },
        //             "children": [
        //                 {"text": "Another node", "icon" : "fa fa-file text-waring"}
        //             ]
        //         }, {
        //             "text": "Another Custom Icon",
        //             "icon": "flaticon2-bell-5 text-waring"
        //         }, {
        //             "text": "Sub Nodes",
        //             "icon": "fa fa-folder text-danger",
        //             "children": [
        //                 {"text": "Item 1", "icon" : "fa fa-file text-waring"},
        //                 {"text": "Item 2", "icon" : "fa fa-file text-success"},
        //                 {"text": "Item 3", "icon" : "fa fa-file text-default"},
        //                 {"text": "Item 4", "icon" : "fa fa-file text-danger"},
        //                 {"text": "Item 5", "icon" : "fa fa-file text-info"}
        //             ]
        //         }]
        //     }
        // ]
    },
    "types" : {
        "default" : {
            "icon" : "fa fa-folder text-success"
        },
        "file" : {
            "icon" : "fa fa-file  text-success"
        }
    },
    "state" : { "key" : "demo2" },
    "plugins" : [ "state", "types" ]
});

// $('#jstree').jstree();

var selected = '';
var parent_id = '';

$('#jstree').on('select_node.jstree', function (e, data) {
    var i, j, r = [];
    for(i = 0, j = data.selected.length; i < j; i++) {
      r.push(data.instance.get_node(data.selected[i]).text);
    }
    parent_id = data.node.li_attr.pid;
    // console.log(data.node.li_attr.pid);
    $('.agent').val(data.node.li_attr.pid);
    $('.parent-id').val(data.node.li_attr.pname);
    console.log('Selected: ' + r.join(', '));
    selected = r.join(', ');
}).jstree();
    