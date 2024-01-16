export const formatDate = (date) => {
    return new Intl.DateTimeFormat("nl-NL", {
        hour: 'numeric',
        minute: 'numeric',
        year: 'numeric',
        month: '2-digit',
        day: 'numeric',
    }).format(new Date(date));
}

export const truncateText = (text, maxLength) => {
    return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
}
