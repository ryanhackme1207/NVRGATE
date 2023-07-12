
  // Get the container element
  const container = document.querySelector('.container');

  // Add event listener to scroll event
  container.addEventListener('scroll', function() {
    // Check if the container is scrolled to the bottom
    if (container.scrollTop + container.clientHeight >= container.scrollHeight) {
      // Load more images or perform any desired action when reaching the bottom
      console.log('Reached the bottom of the container');
    }
  });
