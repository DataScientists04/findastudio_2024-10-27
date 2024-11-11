WITH dates AS (
    SELECT CURDATE() + INTERVAL seq DAY AS date
    FROM (
        SELECT 0 AS seq UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6
        UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10
        -- Continue this pattern to generate more dates if necessary
    ) AS seq
),
next_available AS (
    SELECT s.StudioID, s.Studio_name, s.Postal_code, d.date
    FROM studio s
    CROSS JOIN dates d
    LEFT JOIN reservation r ON s.StudioID = r.StudioID AND r.Reservation_Date = d.date
    WHERE r.Reservation_Date IS NULL
)
SELECT StudioID, Studio_name, Postal_code, MIN(date) AS Next_Available_Date
FROM next_available
GROUP BY StudioID, Studio_name, Postal_code
ORDER BY StudioID, Next_Available_Date
LIMIT 5;
