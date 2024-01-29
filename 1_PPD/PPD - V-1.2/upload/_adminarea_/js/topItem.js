// JavaScript Document
jQuery(function ($) {
	
	"use strict";
		
	  $(document).ready(function () {
            showGraph();
			showTopLovedItem() ;
			showTopViewedItem() ;
			showTopUsers() ;
        });


        function showGraph()
        {
            {
                $.post("topfiveitems.php",
                function (data)
                {
                     var item_name = [];
                    var salesAmt = [];

                    for (var i in data) {
                        item_name.push(data[i].item_name);
                        salesAmt.push(data[i].salesAmt);
                    }

                    var chartdata = {
                        labels: item_name,
                        datasets: [
                            {
                                label: 'Amount($)',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: salesAmt
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
		
		function showTopLovedItem()
        {
            {
                $.post("topfiveloveditems.php",
                function (data)
                {
                     var item_name = [];
                    var lovedCount = [];

                    for (var i in data) {
                        item_name.push(data[i].item_name);
                        lovedCount.push(data[i].lovedCount);
                    }

                    var chartdata = {
                        labels: item_name,
                        datasets: [
                            {
                                label: 'Loved By ',
                                backgroundColor: '#fa498c',
                                borderColor: '#fa498c',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: lovedCount
                            }
                        ]
                    };

                    var graphTarget = $("#loveCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
		function showTopViewedItem()
        {
            {
                $.post("topfivevieweditems.php",
                function (data)
                {
                     var item_name = [];
                    var viewCount = [];

                    for (var i in data) {
                        item_name.push(data[i].item_name);
                        viewCount.push(data[i].viewCount);
                    }

                    var chartdata = {
                        labels: item_name,
                        datasets: [
                            {
                                label: 'Total Views ',
                                backgroundColor: '#50fb26',
                                borderColor: '#50fb26',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: viewCount
                            }
                        ]
                    };

                    var graphTarget = $("#viewCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
		
		function showTopUsers()
        {
            {
                $.post("topfiveusers.php",
                function (data)
                {
                     var uName = [];
                    var purchaseAmt = [];

                    for (var i in data) {
                        uName.push(data[i].uName);
                        purchaseAmt.push(data[i].purchaseAmt);
                    }

                    var chartdata = {
                        labels: uName,
                        datasets: [
                            {
                                label: 'Purchased Amt($) ',
                                backgroundColor: '#1603fa',
                                borderColor: '#1603fa',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: purchaseAmt
                            }
                        ]
                    };

                    var graphTarget = $("#userCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
});