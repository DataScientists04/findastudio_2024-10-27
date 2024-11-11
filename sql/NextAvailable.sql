WITH RECURSIVE dates AS (
    SELECT CURDATE() AS date
    UNION ALL
    SELECT date + INTERVAL 1 DAY
    FROM dates
    WHERE date < CURDATE() + INTERVAL 14 DAY -- Adjust this value to get the next 7, 10, 15, etc. days
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
