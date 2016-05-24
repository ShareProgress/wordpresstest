<?php

// If this file is called directly, abort.
if ( ! defined('WPINC')) {
    die;
}

?><h2>Install New Plugin</h2>

<form action="" method="POST">
    <?php wp_nonce_field('install-plugin'); ?>
    <input type="hidden" name="wppusher[action]" value="install-plugin">
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row">
                    <label>Plugin repository</label>
                </th>
                <td>
                    <input name="wppusher[repository]" type="text" class="regular-text" value="<?php echo (isset($_POST['wppusher']['repository'])) ? $_POST['wppusher']['repository'] : ''; ?>">
                    <p class="description">Example: wppusher/wppusher-plugin</p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label>Repository branch</label>
                </th>
                <td>
                    <input name="wppusher[branch]" type="text" class="regular-text" placeholder="master" value="<?php echo (isset($_POST['wppusher']['branch'])) ? $_POST['wppusher']['branch'] : ''; ?>">
                    <p class="description">Defaults to <strong>master</strong> if left blank</p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label>Repository subdirectory</label>
                </th>
                <td>
                    <input name="wppusher[subdirectory]" type="text" class="regular-text" placeholder="Optional" value="<?php echo (isset($_POST['wppusher']['subdirectory'])) ? $_POST['wppusher']['subdirectory'] : ''; ?>">
                    <p class="description">Only relevant if your plugin resides in a subdirectory of the repository.</p>
                    <p class="description">Example: <strong>awesome-plugin</strong> or <strong>plugins/awesome-plugin</strong></p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label>Repository host</label>
                </th>
                <td>
                    <select name="wppusher[type]">
                        <option value="gh" <?php if (isset($_POST['wppusher']['type']) && $_POST['wppusher']['type'] === 'gh') echo 'selected="selected" '; ?>>GitHub</option>
                        <option value="bb" <?php if (isset($_POST['wppusher']['type']) && $_POST['wppusher']['type'] === 'bb') echo 'selected="selected" '; ?>>Bitbucket</option>
                        <option value="gl" <?php if (isset($_POST['wppusher']['type']) && $_POST['wppusher']['type'] === 'gl') echo 'selected="selected" '; ?>>GitLab</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"></th>
                <td>
                    <label><input type="checkbox" name="wppusher[private]" <?php if (isset($_POST['wppusher']['private'])) echo 'checked'; ?> <?php echo ($hasValidLicense) ? null : 'disabled'; ?>> Repository is private</label>
                    <?php if ( ! $hasValidLicense) { ?>
                        <p class="description">You need a license to use private repositories. <a href="http://wppusher.com#pricing">Get one here.</a></p>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label></label>
                </th>
                <td>
                    <label><input type="checkbox" name="wppusher[ptd]" <?php if (isset($_POST['wppusher']['ptd'])) echo 'checked'; ?>> Push-to-Deploy</label>
                    <p class="description">Automatically update on every push. Read about setup <a target="_blank" href="https://github.com/wppusher/wppusher-documentation/blob/master/push-to-deploy.md">here</a>.</p>
                </td>
            </tr>
            <tr>
                <th scope="row"></th>
                <td>
                    <label><input type="checkbox" name="wppusher[dry-run]" <?php if (isset($_POST['wppusher']['dry-run'])) echo 'checked'; ?>> Dry run</label>
                    <p class="description">For already installed plugins</p>
                    <p class="description">Folder name <strong>must</strong> have the same name as repository</p>
                </td>
            </tr>
        </tbody>
    </table>
    <?php submit_button('Install plugin'); ?>
</form>
