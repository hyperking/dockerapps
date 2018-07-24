# Dev setup
    Create a directory with the following folders
    	- /sites-enabled ( this will store all nginx server config files )
        - /apps ( this will store the repos for each website )
        - /db ( this will store the mysql databases )
        - docker-compose.yml
        - mysql-server
        - nginx-server
        - nginx.conf
        - php-server

# Database setup
    Export the active database dump file and import into the docker mysql DB instance.