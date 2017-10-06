function search() {
    var linksForLocal = []
    var allPages = pageData
    var links = catalogData
    var word = document.getElementById("search").value
    word = word.toUpperCase()
    for (i = 0; i < allPages.length; i++) {
        var link1 = allPages[i]["link"];
        var title = allPages[i]["title"];
        var table = allPages[i]["table"];
        var image = "../" + allPages[i]["image"];
        if (link1.length > 1)
            var link1 = link1.split("\\")
        var long = link1.length
        link1 = link1[long - 1]
        link1 = "../../page/" + link1

        if (title !== undefined) {
            // title.split('"')
            // table.split('"')
            // link1.split('"')

            if (title.toUpperCase().indexOf(word) > -1 || table.toUpperCase().indexOf(word) > -1 || link1.toUpperCase().indexOf(word) > -1) {
                for (k = 0; k < links.length; k++) {
                    if (link1 == links[k]["link"]) {
                        var haveAlready = 0;
                        if (linksForLocal.length == 0) {
                            linksForLocal.push({ "link": link1, "title": title, "table": table, "image": image })
                        } else {
                            for (l = 0; l < linksForLocal.length; l++) {
                                if (link1 == linksForLocal[l]["link"]) {
                                    haveAlready = 1;
                                }

                            }
                            if (haveAlready == 0)
                                linksForLocal.push({ "link": link1, "title": title, "table": table, "image": image })
                        }


                    }

                }

            }


        }
    }
    localStorage.setItem("SearchResult", JSON.stringify(linksForLocal))
    window.open("..\\..\\shared\\scripts\\searchResult.html", '_blank');
}