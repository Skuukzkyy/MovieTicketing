$(document).ready(function (){
    const movieContainerHtml = $(".all-movies-container").html();
    
    $("#searchBar").on("input", function(){
        const keyword = this.value
        $.ajax({
            url: "search_movie.php",
            method: "POST",
            data: {
                searchMovie: true,
                keyword: keyword
            },
            success: function(res, status, xhr){
                console.log(res)
                if(keyword == ""){
                    console.log("blanko")
                    $(".top-picks-container").show()
                    $(".new-releases-container").show()
                    $(".head").show()
                    $("hr").show()
                    $("#search-title").html("")
                    $(".all-movies-container").html(movieContainerHtml)
                }else{
                    $(".top-picks-container").hide()
                    $(".new-releases-container").hide()
                    $(".head").hide()
                    $("hr").hide()
                    $("#search-title").html("Search Result");
                    $(".all-movies-container").html(res)
                }
            },
            error: function(xhr, status, error){
                console.log(error)
            }
        })
    })
})