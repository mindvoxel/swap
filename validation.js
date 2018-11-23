/*This page will perform client side validation for all parts of the website. Any page
that needs JS validation will run this script*/


//validate the file_name
validate_file = function(){
    //file 
    file_element = document.getElementById('file');
    file_name = file_element.value;
    console.log(file_name);//print the file path for debugging
    //split the file on "." and check the last part of the string
    split_path = file_name.split(".");
    //the last item should be the length of the split array - 1
    last = (split_path.length - 1);

    if (split_path[last] === "png" || split_path[last] === "jpg" || split_path[last] === "jpeg"){
        return true;
    }

    alert("Please select a file with .jpg, .jpeg, or .png extension.");
    return false;
}

//register event listeners
main = function(){
    //form
    form_element = document.getElementById('insert_form');
    form_element.onsubmit = validate_file; //function pointer
}

main();

