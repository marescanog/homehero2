<?php
    $data_featured = array(
        array(
            "id"=>"0", 
            "name"=>"Jeremy Myers", 
            "projects_completed"=>"63",
            "skills"=> array(
                array("name"=>"Plumbing", "rate_type"=>"daily", "price"=>"300"),
                array("name"=>"Pipe Installation", "rate_type"=>"project", "price"=>"600-1500")
            ),
            "Description"=> "I am a TESDA certified pipe installer and I also have experience in other plumbing repairs such as fixing leaks and broken sinks. I can bring my own tools and start anytime.",
            "profile_picture"=>"ProfilePic1.jpg",
            "rating"=>4.75,
            "hasRatings"=>true
        ),
        array(
            "id"=>"1", 
            "name"=>"Joseph Santos", 
            "projects_completed"=>"19",
            "skills"=> array(
                array("name"=>"Gadget Repair", "rate_type"=>"project", "price"=>"450"),
                array("name"=>"Technician", "rate_type"=>"hr", "price"=>"250"),
                array("name"=>"Laptop repair", "rate_type"=>"message", "price"=>"0")
            ),
            "Description"=> "Graduating student ko sa Asian College of Technology (ACT) BSIT unya nag freelance ko ug repair ng mga gadget ug devices. Dati nagtrabaho ko sa Junrex cellphone repairs pero karon kay nagfreelance ko.",
            "profile_picture"=>"ProfilePic2.jpg",
            "rating"=>4,
            "hasRatings"=>true
        ),
        array(
            "id"=>"2", 
            "name"=>"Erik Manalastas", 
            "projects_completed"=>"124",
            "skills"=> array(
                array("name"=>"Carpentry", "rate_type"=>"day", "price"=>"450")
            ),
            "Description"=> "Barato ra akong presyo unya pwede ra sad mahangyo pero depende sad sa unsay buhaton nako. Daghan na kaayo ko projects nahuman unya lipay kaayo ako mga bossing.",
            "profile_picture"=>"ProfilePic3.jpg",
            "rating"=>5,
            "hasRatings"=>true
        ),
    );

    // PHP ASSOC ARRAY STRUCTURE GUIDE
    // GET PERSON
    // syntax
    //var_dump($data_featured[0]);
    // DATA FORMAT
    //array(6) { ["id"]=> string(1) "0" ["name"]=> string(11) "Herald Chiu" ["rating"]=> string(4) "4.75" ["projects_completed"]=> string(2) "63" ["skills"]=> array(2) { [0]=> array(3) { ["skill"]=> string(8) "Plumbing" ["rate_type"]=> string(5) "daily" ["price"]=> string(3) "300" } [1]=> array(3) { ["skill"]=> string(17) "Pipe Installation" ["rate_type"]=> string(7) "project" ["price"]=> string(8) "600-1500" } } ["Description"]=> string(173) "I am a TESDA certified pipe installer and I also have experience in other plumbing repairs such as fixing leaks and broken sinks. I can bring my own tools and start anytime." }

    // GET PERSON NAME
    // syntax
    // var_dump($data_featured[0]["name"]);
    // DATA FORMAT
    // string(11) "Herald Chiu"

    // GET SKILL LIST
    // syntax
    // var_dump($data_featured[0]["skills"]);
    // array(3) { ["skill"]=> string(8) "Plumbing" ["rate_type"]=> string(5) "daily" ["price"]=> string(3) "300" }

    // GET SKILL INFO
    // syntax
    // var_dump($data_featured[0]["skills"][0]);
    // array(3) { ["name"]=> string(8) "Plumbing" ["rate_type"]=> string(5) "daily" ["price"]=> string(3) "300" }
