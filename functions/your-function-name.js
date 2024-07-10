const { exec } = require('child_process');

exports.handler = async (event, context) => {
  return new Promise((resolve, reject) => {
    exec('php -f /path/to/your/script.php', (error, stdout, stderr) => {
      if (error) {
        console.error('Error ejecutando PHP:', error);
        return reject({
          statusCode: 500,
          body: JSON.stringify({
            message: 'Error ejecutando PHP',
            error: error.message,
            stderr: stderr
          })
        });
      }
      resolve({
        statusCode: 200,
        body: stdout
      });
    });
  });
};