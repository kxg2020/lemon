var client = algoliasearch(window.algolia_config.app_id, window.algolia_config.app_key)
var post_index = client.initIndex('posts')
var old_key = ""
$("#search-input").bind('input propertychange', function() {
    var key = $(this).val()
    if(key.length < 1 || key == old_key){
        return false
    }
    old_key = key
    post_index.search(key, function (err, response) {
        if(err){
            console.log(err)
            return false
        }
        if(response){
            if(response.nbHits == 0){
                var searchHeaderMsg = "抱歉，没有找到相关内容"
                $("#search-msg").html(searchHeaderMsg)
                $(".search-list").html("")
                return false
            }
            var searchHeaderMsg = response.nbHits + " results found in " + response.processingTimeMS +  " ms"
            var searchListHtml = "<div class=\"content recent-post\">"
            $.each(response.hits, function (index, item) {
                searchListHtml += "<div class=\"recent-single-post\">\n" +
                    "<a href=\"/post/" + item.slug + "\" class=\"new-post-title\">" + highSearch(key, item.title) + "</a>\n" +
                    "</div>"
            })
            searchListHtml += "</div>"
            $("#search-msg").html(searchHeaderMsg)
            $(".search-list").html(searchListHtml)
        }
    })
})

$("#search-show").bind("click", function(){
    $(".search-bg").show()
    $(".search").show()
    $("html").css("overflow", "hidden")
})

$("#search-hide").bind("click", function(){
    $(".search-bg").hide()
    $(".search").hide()
    $("html").css("overflow", "auto")
})

function highSearch(key, str) {
    return str.replace(new RegExp(key, "g"), "<em class=\"search-highlight\">" + key + "</em>")
}