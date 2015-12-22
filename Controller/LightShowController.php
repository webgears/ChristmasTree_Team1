<?php

namespace Controller;

class LightShowController implements ILightShowController
{
    const MUSIC_FOLDER = "/home/pi/lightshowpi/music/";
    const PLAYLIST = "/home/pi/lightshowpi/playlist/playlist.txt";
    const CMD_PLAY = "sudo nohup python /home/pi/lightshowpi/py/synchronized_lights.py --file={path}";
    const CMD_PLAY_ONE_OF_LIST = "sudo nohup python /home/pi/lightshowpi/py/synchronized_lights.py --playlist={path}";
    const CMD_PLAY_LIST = "sudo start_music_and_lights";
    const CMD_STOP_LIST = "sudo stop_music_and_lights";

    /**
     * Returns an array with all the songs
     *
     * @return string[] The mp3 files
     * @throws \Exception
     */
    public function getSongs()
    {
        $result = array();
        if($handle = @opendir(self::MUSIC_FOLDER)) {

            while(($entry = @readdir($handle)) !== false) {
                // Ends with .mp3
                if(strpos($entry, '.mp3', strlen($entry) - 4)) {
                    $result[] = '/home/pi/lightshowpi/music/' . $entry;
                }
            }

            @closedir($handle);
        } else {
            throw new \Exception("Could not read directory");
        }

        return $result;
    }

    /**
     *
     * Plays the file
     *
     * @param $mp3_file
     */
    public function play($mp3_file)
    {
        $command = escapeshellcmd(str_replace("{path}", $mp3_file, self::CMD_PLAY));
        exec($command . ' &');
    }

    /**
     * Stops the music
     */
    public function stop()
    {
        // TODO: Implement stop() method.
    }

    /**
     * Plays the playlist
     */
    public function playPlaylist()
    {
        $command = escapeshellcmd(str_replace("{path}", self::PLAYLIST, self::CMD_PLAY_ONE_OF_LIST));
        exec($command . ' &');
    }

    /**
     * @return array The content of the playlist
     */
    public function getPlaylistContent()
    {
        $songs = array();
        $playlist_file = fopen(self::PLAYLIST, "r");
        if ($playlist_file) {
            while(($line = fgets($playlist_file)) !== false) {
                $line_content = explode("\t", $line);
                array_push($line_content[0], $songs);
            }
        } else {
            echo("unable to read playlist file");
        }

        return $songs;
    }

    /**
     * Adds a new entry to the playlist
     *
     * @param $title
     * @param $mp3_file
     * @return mixed
     */
    public function addToPlaylist($title, $mp3_file)
    {
        // TODO: Implement
    }

    /**
     * Clears the content of the playlist
     */
    public function clearPlaylist()
    {
        // TODO: Implement clearPlaylist() method.
    }
}