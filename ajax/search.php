<?php

    session_start();

    require_once '../config/Db.php';
    require_once '../model/Logs.php';
    require_once '../controller/LogsController.php';

    $logsController = new Logs();

    $search = trim($_GET['search'] ?? '');
    $perPage = 10;
    $page = isset($_GET['p']) ? max(1, intval($_GET['p'])) : 1;
    $offset = ($page - 1) * $perPage;

    if(isset($_GET['action']) && $_GET['action'] === 'search'){

        if($search != ''){
            $logs = $logsController->showSearchResult($search, $perPage, $offset);

            $total = $logsController->countSearchResult($search);

            $totalPages = ceil($total / $perPage);

            ob_start();

            if(!empty($logs)){
                foreach($logs as $log){
                    $hours = floatval($log['totalHours']);
                    ?>
                    <tr data-id="<?= $log['id'] ?>" data-date="<?= $log['date'] ?>" data-timein="<?= $log['timeIn'] ?>" data-timeout="<?= $log['timeOut'] ?>" data-activity="<?= htmlspecialchars($log['activity']) ?>">
                        <td><?= htmlspecialchars(date('M d Y', strtotime($log['date']))) ?></td>
                        <td><?= htmlspecialchars(date('g:i a', strtotime($log['timeIn']))) ?></td>
                        <td><?= htmlspecialchars(date('g:i a', strtotime($log['timeOut']))) ?></td>
                        <td><?= ($hours == intval($hours)) ? intval($hours) : $hours ?></td>
                        <td><?= htmlspecialchars($log['activity']) ?></td>
                        <td class="logs-actions">
                            <p class="logs-edit">Edit</p>
                            <p class="logs-delete" data-id="<?= $log['id'] ?>">Delete</p>
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
    }