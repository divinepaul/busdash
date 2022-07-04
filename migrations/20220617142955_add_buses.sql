-- migrate:up
INSERT INTO bus_stops (
    name,loc_lat,loc_long,address
) VALUES ( 
    "Angamaly KSRTC complex",
    10.195476, 76.386234,
    "Angamaly KSRTC complex,683589"
);

INSERT INTO bus_stops (
    name,loc_lat,loc_long,address
) VALUES ( 
    "Aluva KSRTC stand",
    10.106408, 76.356249,
    "Aluva KSRTC stand,683580"
);

INSERT INTO bus_stops (
    name,loc_lat,loc_long,address
) VALUES ( 
    "Telk KSRTC Bus Stop",
    10.1784342127733, 76.37800535373032,
    "Salem-Kochi Hwy, Angamaly South,683573"
);

INSERT INTO bus_stops (
    name,loc_lat,loc_long,address
) VALUES ( 
    "Kariyad bus stop",
    10.162456430622596, 76.36894705267174,
    "Karyiyad Junction,683585"
);

INSERT INTO bus_stops (
    name,loc_lat,loc_long,address
) VALUES ( 
    "Athani bus stop",
    10.154470206681726, 76.35479719596067,
    "Athani,683585"
);


INSERT INTO bus_stops (
    name,loc_lat,loc_long,address
) VALUES ( 
    "Nedumbasserry Post Office Bus Stop",
    10.146518983972785, 76.35374995967612,
    "Athani, Kerala 683102"
);


INSERT INTO bus_stops (
    name,loc_lat,loc_long,address
) VALUES ( 
    "Desom Junction Bus Stop",
    10.129999258915205, 76.35166079288616,
    "Desom, Aluva, Kerala 683102"
);

INSERT INTO bus_stops (
    name,loc_lat,loc_long,address
) VALUES ( 
    "Paravur Kavala",
    10.120037469161458, 76.34299728450661,
    "Thottakkattukara, Aluva, Kerala 683108"
);

INSERT INTO bus_stops (
    name,loc_lat,loc_long,address
) VALUES ( 
    "Aluva Bank Junction Bus Stop",
    10.11243643501175, 76.35283764724446,
    "Bridge Rd, Periyar Nagar, Aluva, Kerala 683101"
);

-- migrate:down
DELETE FROM bus_stops;
