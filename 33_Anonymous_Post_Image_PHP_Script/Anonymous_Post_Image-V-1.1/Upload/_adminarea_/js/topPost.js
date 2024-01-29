// JavaScript Document
jQuery(function ($) {
	
	"use strict";
		
	  $(document).ready(function () {
			showTopLovedPost() ;
			showTopViewedPost() ;
			showTopLikedPost() ;
        });

		
		function showTopLovedPost()
        {
            {
                $.post("topfivelovedPost.php",
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
                                backgroundColor: '#fb5e46',
                                borderColor: '#fb5e46',
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
		function showTopViewedPost()
        {
            {
                $.post("topfiveviewedPost.php",
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
		
		function showTopLikedPost()
        {
            {
                $.post("topfivelikedPost.php",
                function (data)
                {
                     var item_name = [];
                    var likedCount = [];

                    for (var i in data) {
                        item_name.push(data[i].item_name);
                        likedCount.push(data[i].likedCount);
                    }

                    var chartdata = {
                        labels: item_name,
                        datasets: [
                            {
                                label: 'Liked By ',
                                backgroundColor: '#1603fa',
                                borderColor: '#1603fa',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: likedCount
                            }
                        ]
                    };

                    var graphTarget = $("#likeCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
});