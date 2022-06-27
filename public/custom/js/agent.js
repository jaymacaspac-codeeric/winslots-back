// $('#jstree').jstree({
//     "core" : {
//         "themes" : {
//             "responsive": false
//         },
//         // so that create works
//         "check_callback" : true,
//         'multiple': false,
//         'data' : [
//             { "id" : "ajson1", "parent" : "#", "text" : "Simple root node" },
//             { "id" : "ajson2", "parent" : "#", "text" : "Root node 2" },
//             { "id" : "ajson3", "parent" : "ajson2", "text" : "Child 1" },
//             { "id" : "ajson4", "parent" : "ajson2", "text" : "Child 2" },
//          ]
//     },
//     "types" : {
//         "default" : {
//             "icon" : "fa fa-folder text-success"
//         },
//         "file" : {
//             "icon" : "fa fa-file  text-success"
//         }
//     },
//     "state" : { "key" : "demo2" },
//     "plugins" : [ "state", "types" ]
// });

// // $('#jstree').jstree();

// var selected = '';
// var parent_id = '';

// $('#jstree').on('select_node.jstree', function (e, data) {
//     var i, j, r = [];
//     for(i = 0, j = data.selected.length; i < j; i++) {
//       r.push(data.instance.get_node(data.selected[i]).text);
//     }
//     parent_id = data.node.li_attr.pid;
//     // console.log(data.node.li_attr.pid);
//     $('.agent').val(data.node.li_attr.pid);
//     $('.parent-id').val(data.node.li_attr.pname);
//     console.log('Selected: ' + r.join(', '));
//     selected = r.join(', ');
// });
    