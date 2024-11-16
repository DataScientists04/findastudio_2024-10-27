WITH RECURSIVE dates AS (
    SELECT CURDATE() AS date
    UNION ALL
    SELECT date + INTERVAL 1 DAY
    FROM dates
    WHERE date < CURDATE() + INTERVAL 6 DAY
)
SELECT d.date,
  CASE WHEN r.UserID = ? THEN 'Booked by you'
  WHEN r.Reservation_Date IS NOT NULL THEN 'Reserved'
  ELSE 'Available'
  END AS status
FROM dates d
LEFT JOIN reservation r ON r.StudioID = ? AND r.Reservation_Date = d.date
ORDER BY d.date;