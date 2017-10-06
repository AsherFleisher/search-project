 function searchResult() {
     if (localStorage["SearchResult"] === "[]") {
         document.write("No match was found!")
     } else {
         var linksForLocal = JSON.parse(localStorage["SearchResult"])
         for (i = 0; i < linksForLocal.length; i++) {
             var link1 = linksForLocal[i]["link"]
             var title = linksForLocal[i]["title"]
             var image = linksForLocal[i]["image"]
             var p = document.createElement("p")
             p.setAttribute("class", "content")
             var a = document.createElement("a")
             a.setAttribute("href", link1)
             a.setAttribute("target", "_blank")
             a.innerHTML = title.toUpperCase() + " <br/>"
             var img = document.createElement("img")
             img.setAttribute("src", image)
             img.setAttribute("span_r", "")
             a.appendChild(img)
             p.appendChild(a)
             document.getElementById("popup").appendChild(p);

         }
         localStorage.setItem("SearchResult", "")
     }
 }