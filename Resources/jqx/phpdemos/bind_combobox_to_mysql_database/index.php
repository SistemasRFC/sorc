<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../jqwidgets/styles/jqx.base.css" type="text/css" />
    <link rel="stylesheet" href="../../jqwidgets/styles/jqx.classic.css" type="text/css" />
    <script type="text/javascript" src="../../scripts/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="../../jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../../jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="../../jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="../../jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="../../jqwidgets/jqxlistbox.js"></script>
     <script type="text/javascript" src="../../jqwidgets/jqxcombobox.js"></script>
   <script type="text/javascript">
        $(document).ready(function () {
            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'CompanyName', type: 'string'},
                    { name: 'ContactName', type: 'string'},
                    { name: 'ContactTitle', type: 'string'},
                    { name: 'Address', type: 'string'},
                    { name: 'City', type: 'string'}
                ],
				cache: false,
                url: 'data.php'
            };

            var dataAdapter = new $.jqx.dataAdapter(source);
			
			$("#jqxcombobox").jqxComboBox(
            {
                source: dataAdapter,
                theme: 'classic',
				width: 200,
				height: 25,
				selectedIndex: 0,
				displayMember: 'CompanyName',
				valueMember: 'ContactName'
            });        
        });
    </script>
</head>
<body class='default'>
   <div id="jqxcombobox"></div>
</body>
</html>
