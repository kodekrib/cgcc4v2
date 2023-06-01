function Post(url, data, isLoading = false, contentType = "multipart/form-data") {

    return new Promise((resolve, reject) => {
        if(isLoading){
            $("div.spanner").addClass("show");
            $("div.overlay").addClass("show");
        }

        $.ajax({
            headers: { "x-csrf-token": _token },
            url: url,
            type: "POST",
            //contentType: contentType,
            data: data,
            success: (dt) => {
                $("div.spanner").removeClass("show");
                $("div.overlay").removeClass("show");
                resolve(dt);
            },
            error: (error)  => {
                $("div.spanner").removeClass("show");
                $("div.overlay").removeClass("show");
                reject(error);
            },
        });
    });
}


function Get(url, isLoading = false) {
    return new Promise((resolve, reject) => {
        if(isLoading){
            $("div.spanner").addClass("show");
            $("div.overlay").addClass("show");
        }

        $.ajax({
            headers: { "x-csrf-token": _token },
            url: url,
            type: "GET",
            success: (dt) =>  {
                $("div.spanner").removeClass("show");
                $("div.overlay").removeClass("show");
                resolve(dt);
            },
            error:  (error) => {
                $("div.spanner").removeClass("show");
                $("div.overlay").removeClass("show");
                reject(error);
            },
        });
    });
}
