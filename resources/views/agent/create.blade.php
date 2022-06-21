@extends('template.template')

@section('custom-css')
<link href="../assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
<link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<style>
    .bet_history_table thead th {
        /* font-size: 12px; */
        word-break: keep-all;
        /* white-space: nowrap; */
        border: 1px solid #e3e6f0;
        border-bottom: 2px solid #e3e6f0;
    }

    .bet_history_table tbody td {
        font-size: 14px;
        word-break: keep-all;
        /* white-space: nowrap; */
        vertical-align: middle;
        padding: 0.25rem 0.45rem 0.25rem 0.45rem !important;
    }
    .user-betting-details table tbody td {
        font-size: 14px;
        padding: 0.45rem !important;
        border-color: #b6d7f7;
    }
    .tree li div {
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border: 1px dotted #999;
        border-radius: 5px;
        display: inline-block;
        padding: 3px 8px;
        text-decoration: none;
        -webkit-transition: color .2s ease .1s,background-color .2s ease .1s,border-color .3s ease .2s;
        -moz-transition: color .2s ease .1s,background-color .2s ease .1s,border-color .3s ease .2s;
        -o-transition: color .2s ease .1s,background-color .2s ease .1s,border-color .3s ease .2s;
        transition: color .2s ease .1s,background-color .2s ease .1s,border-color .3s ease .2s;
        padding: 7px;
        cursor: pointer;
    }
</style>
@endsection



@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Create Agent</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Create Agent</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Agent Tree
                    <div class="card-actions">

                    </div>
                </div>
                <div class="card-body">

                    <div id="agent_jstree"></div>

                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home5" role="tab" aria-controls="home5" aria-expanded="true"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Create Sub-Agent</span></a> </li>
                        {{-- <li class="nav-item"> <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile5" role="tab" aria-controls="profile" aria-expanded="false"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Create Sub-Agent</span></a></li> --}}
                    </ul>
                    <div class="tab-content tabcontent-border p-20" id="myTabContent">
                        <div role="tabpanel" class="tab-pane fade active show" id="home5" aria-labelledby="home-tab" aria-expanded="true">
                            <form class="form-horizontal create-agent-form" role="form">
                                {!! csrf_field() !!}
                                <input type="hidden" name="level" class="level" value="">
                                <input type="hidden" name="agent" class="agent" value="">
                                <input type="hidden" name="affiliated_agent" class="affiliated_agent" value="">
        
                                <div class="form-group row">
                                    <label for="parent" class="col-sm-2 col-form-label">Parent ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="parent_id" class="form-control parent-id" id="parent" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="agentid" class="col-sm-2 col-form-label">Agent ID</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input type="text" name="agent_username" class="form-control agent-id" id="agentid" required>
                                            <a class="input-group-addon btn btn-warning check-agent-id text-white">
                                                <i class="fa fa-refresh fa-spin username-loading" style="display: none;"></i>&nbsp;
                                                <span class="check-label"> Check</span>
                                            </a>
                                        </div>
                                        <span class="help-block m-b-none text-danger text_agent_chk" id="text_agent_chk">아이디 중복 확인을 필요합니다.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputHorizontalWarning" class="col-sm-2 col-form-label">Nickname</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="agent_nick" class="form-control" id="inputHorizontalWarning" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="agent_pw" class="form-control" id="password" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="rate" class="col-sm-2 col-form-label">Rate</label>
                                    <div class="col-sm-4 input-group">
                                        <input type="text" name="rate" class="form-control" id="rate" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                    <label for="commission" class="col-sm-2 col-form-label">Commision</label>
                                    <div class="col-sm-4 input-group">
                                        <input type="text" name="commission" class="form-control" id="commission" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-month-input" class="col-md-2 col-form-label">Memo</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="memo" maxlength="500" id="inputHorizontalDnger" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn waves-effect waves-light btn-info save-agent">Save</button>
                                </div>
                            </form>
                        </div>

                        {{-- <div class="tab-pane fade" id="profile5" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="false">
                            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="betDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Bet Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/toast-master/js/jquery.toast.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

    <script src="{{ URL::asset('custom/js/agent.js') }}"></script>

    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $('#jstree').jstree({
        //     "core" : {
        //         "themes" : {
        //             "responsive": false
        //         },
        //         // so that create works
        //         "check_callback" : true,
        //         'multiple': false,
        //         'json_data': {
        //             'ajax': {
        //                 'url': "{{ url('/agent-tree') }}",
        //                 'type': 'GET',
        //                 'data': function(node) {
        //                     console.log(node);
        //                     return {
        //                         'nodeId': node.attr ? node.attr("pid") : ''
        //                     };
        //                 }
        //             },
        //             'progressive_render': true,
        //             'progressive_unload': false
        //             },
        //         },
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
        // <i class="fa fa-plus-square-o text-primary"></i>
        var jstree = '';
        $(function () {
            $.ajax({
                async: true,
                type: "GET",
                url: "{{ url('/agent-tree') }}",
                success: function (json) {
                    jstree = $('#agent_jstree').jstree({ 'core' : {
                        "themes" : {
                            "variant" : "large"
                        },
                        'data' : JSON.parse(json),
                        'multiple': false,
                        "types" : {
                            "default" : {
                                "icon" : "fa fa-folder text-success"
                            }
                        }
                    } });
                },

                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });  
        });

        var selected = '';
        var parent_id = '';

        $('#agent_jstree').on('select_node.jstree', function (e, data) {
            var i, j, r = [];
            for(i = 0, j = data.selected.length; i < j; i++) {
                r.push(data.instance.get_node(data.selected[i]).text);
            }
            parent_id = data.node.li_attr.pid;

            $('.agent').val(data.node.li_attr.pid);
            $('.parent-id').val(data.node.li_attr.pname);
            $('.level').val(data.node.li_attr.lvl);

            var parent = data.node.li_attr.pname != 'greatgame' ? data.node.li_attr.parent : "";
            if(parent == "") {
                if(data.node.li_attr.lvl == 1) {
                    parent = data.node.li_attr.pid;
                }
            }

            $('.affiliated_agent').val(parent);
            // console.log('Selected: ' + r.join(', '));
            selected = r.join(', ');
        });

        $("#agent_jstree").on("ready.jstree", function (e, data) {
            var target = jstree.jstree();
            // $("#"+data.node.id+"_anchor").append('<div class="agent-commands text-right"><i class="fa fa-plus-square-o text-primary"></i></div>');
        });

        var is_checked = false;
        var is_duplicate = true;

        $('.check-agent-id').on('click', function(e) {
            var agent_id = $('.agent-id').val();

            if(agent_id.length < 5) {
                console.log('less than 5');
            }

            if (agent_id != '') {
                $.ajax({
                    url: "{{ url('/check-duplicate-agent') }}",
                    type: 'POST',
                    data: {'id': agent_id},
                    beforeSend: function() {
                        $('.username-loading').css('display', 'block');
                        $('.agent-id').attr('disabled', true);
                        $('.check-label').text('Checking...');
                        $('.text_user_chk').text('Processing.');
                        is_checked = false;
                    },
                    success: function(data) {
                        console.log(data);
                        is_checked = true;
                        $('.username-loading').css('display', 'none');
                        $('.agent-id').attr('disabled', false);
                        $('.check-label').text('Check');
                        if (data == 'duplicate') {
                            $('.text_agent_chk').text('이미 사용중입니다.').addClass('text-danger');
                            is_duplicate = true;
                        } else {
                            $('.text_agent_chk').text('사용가능합니다.').removeClass('text-danger');
                            $('.text_agent_chk').addClass('text-success');
                            is_duplicate = false;
                        }
                    }
                })
            }
        });  

        $('.save-agent').on('click', function() {
            console.log(is_duplicate);
            if(is_checked && !is_duplicate) {
                var agent_form = $('.create-agent-form').serialize();
                $.ajax({
                    url: "{{ url('/save-agent') }}",
                    type: 'POST',
                    data: agent_form,
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if(data == 'success') {
                            // swal("Success!", 'Agent created successfully.', "success");
                            swal({
                                title: "Success!",
                                text: "Agent created successfully.",
                                type: "success",
                                showConfirmButton: true
                                }, function() {
                                    location.reload();
                                });
                        }
                    }
                });
            } else {

            }
        });
    
    </script>
@endsection
