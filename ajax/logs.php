<?php
    session_start();

    require_once '../config/Db.php';
    require_once '../model/Logs.php';
    require_once '../controller/LogsController.php';

    $logsController = new Logs();
    $perPage = 10;
    $page = isset($_GET['p']) ? max(1, intval($_GET['p'])) : 1;
    $offset = ($page - 1) * $perPage;
    $totalPages = $logsController->countLogs();

    $totalPages = ceil($totalPages / $perPage);

    if ($_GET['action'] === 'get') {
        $logsController = new Logs();
        $perPage = 10;
        $page = isset($_GET['p']) ? max(1, intval($_GET['p'])) : 1;
        $offset = ($page - 1) * $perPage;
        $total = $logsController->countLogs();
        $totalPages = ceil($total / $perPage);
        $tasks = $logsController->showLogs($perPage, $offset);

        ob_start();

        if (!empty($tasks)) {
            foreach ($tasks as $task) {
                $hours = floatval($task['totalHours']);
                ?>
                <tr data-id="<?= $task['id'] ?>" data-date="<?= $task['date'] ?>" data-timein="<?= $task['timeIn'] ?>" data-timeout="<?= $task['timeOut'] ?>" data-activity="<?= htmlspecialchars($task['activity']) ?>">
                    <td><?= htmlspecialchars(date('M d Y', strtotime($task['date']))) ?></td>
                    <td><?= htmlspecialchars(date('g:i a', strtotime($task['timeIn']))) ?></td>
                    <td><?= htmlspecialchars(date('g:i a', strtotime($task['timeOut']))) ?></td>
                    <td><?= ($hours == intval($hours)) ? intval($hours) : $hours ?></td>
                    <td><?= htmlspecialchars($task['activity']) ?></td>
                    <td class="logs-actions">
                        <p class="logs-edit">Edit</p>
                        <p class="logs-delete" data-id="<?= $task['id'] ?>">Delete</p>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo '<tr><td colspan="6">No Activities</td></tr>';
        }

        $tbody = ob_get_clean();

        echo json_encode([
            'tbody' => $tbody,
            'start' => $offset + 1,
            'end' => min($offset + $perPage, $total),
            'total' => $total,
            'totalPages' => $totalPages
        ]);
        exit();
    }