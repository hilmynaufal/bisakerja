<div id="chart-container"></div>



@script
<script>
    // let datascource =
    // {
    //     'id': '1',
    //     'name': 'Su Miao',
    //     'title': 'department manager',
    //     'relationship': '111',
    //     'children': [{ 'id': '2', 'name': 'Tie Hua', 'title': 'senior engineer', 'relationship': '110' }, { 'id': '3', 'name': 'Hei Hei', 'title': 'senior engineer', 'relationship': '111' }]
    // };
    // let ajaxURLs = {
    //     'children': '/peta_jabatan/children/',
    //     'parent': '/orgchart/parent/',
    //     'siblings': function (nodeData) {
    //         return '/orgchart/siblings/' + nodeData.id;
    //     },
    //     'families': function (nodeData) {
    //         return '/orgchart/families/' + nodeData.id;
    //     }
    // };
    $('#chart-container').orgchart({
        'chartContainer': '#chart-container',
        'data': @json($data),
        'nodeContent': 'name',
        'depth': 2,
        'verticalDepth': 2,
        'visibleLevel': 2,
        'nodeId': 'id',
        'pan' : true,
        'zoom': true
    });
</script>
@endscript