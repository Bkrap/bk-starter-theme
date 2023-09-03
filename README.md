Created by Bruno Krapljan

Simple front building structure with webpack compiler + watcher for js & css

Requirements:
- node v14

1. npm install
    - install webpack and rest of devDependecies
2. npm run copy
    - will install dependencies like bootstrap e.g (add/change new copy path from node_modules to vendor for dependencies in 'root/dist/copy-files.js)
    - don't forget to include dependencies scss in the root/src/scss/main.scss
    - don't forget to include JS files in webpack.config.js (search for "main": glob.sync('./src/js/**/*.js') and follow the logic)
    - don't forget to include that new builded js into "\root-theme\includes\enqueue.php"
2. npm run build 
    - root/src/scss/main.scss compiles the scss to 'build/styles.css' & all js files inside '/src/js/' to '/build/main.js'

/***/
Frontend part:

1. Go to frontend-template.php and you will see routes from 'root/frontend'
2. Add new modules inside 'root/frontend/' and include them into 'root/forntend-template.php'
3. After that you need to access the page to see your frontend.
 - Go to wordpress admin backend
 - Go to pages and add new page
 - Under 'Page Attributes' add 'Template' -> Frontend Template
 - View the page