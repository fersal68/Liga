const { exec } = require('child_process');

exports.handler = async (event, context) => {
  return new Promise((resolve, reject) => {
    exec('php -v', (error, stdout, stderr) => {
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
      console.log('PHP version:', stdout);

      exec('php -f /opt/build/repo/index.php', (error, stdout, stderr) => {
        if (error) {
          console.error('Error ejecutando script PHP:', error);
          return reject({
            statusCode: 500,
            body: JSON.stringify({
              message: 'Error ejecutando script PHP',
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
  }).catch((err) => {
    console.error('Unhandled error:', err);
    return {
      statusCode: 500,
      body: JSON.stringify({
        message: 'Unhandled error',
        error: err.message,
        details: err
      })
    };
  });
};