-- migrate:up
INSERT INTO bus_stops (
    id,name,loc_lat,loc_long,address
) VALUES ( 
    1,
    "Angamaly KSRTC complex",
    10.195476, 76.386234,
    "Angamaly KSRTC complex,683589"
);


-- migrate:down

