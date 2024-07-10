const { exec } = require('child_process');

exports.handler = async (event, context) => {
  return new Promise((resolve, reject) => {
    exec('php -f /path/to/your/script.php', (error, stdout, stderr) => {
      if (error) {
        reject({
          statusCode: 500,
          body: stderr
        });
      } else {
        resolve({
          statusCode: 200,
          body: stdout
        });
      }
    });
  });
};